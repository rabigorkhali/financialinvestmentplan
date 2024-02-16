<?php


namespace App\Http\Controllers\System\Auth;

use App\Exceptions\CustomGenericException;
use App\Http\Controllers\Controller;
use App\Mail\system\TwoFAEmail;
use App\Model\Language;
use App\Model\Locale;
use App\Model\Loginlogs;
use App\Services\System\UserService;
use App\Traits\CustomThrottleRequest;
use Auth;
use Carbon\Carbon;
use GuzzleHttp;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Config;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers, CustomThrottleRequest;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle a login request to the application.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function showLoginForm(Request $request)
    {
        if (Auth::check()) {
            return redirect('/' . getSystemPrefix() . '/home');
        } else {
            if ($request->has('redirect')) {
                $redirectUrl = $request->redirect;
                return view('system.auth.login', compact('redirectUrl'));
            }
            return view('system.auth.login');
        }
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        try {
            if (
                method_exists($this, 'hasTooManyAttempts') &&
                $this->hasTooManyAttempts($request, Config::get('constants.DEFAULT_LOGIN_ATTEMPT_LIMIT')) // maximum attempts
            ) {
                $this->customFireLockoutEvent($request);

                return $this->customLockoutResponse($request);
            }
            $user = $this->loginType($request);

            if (Auth::attempt($user)) {
                setRoleCache(authUser()->load('role'));
                setConfigCookie();
                $this->createLoginLog($request);

                return $this->sendLoginResponse($request);
            }

            $this->incrementAttempts($request, Config::get('constants.DEFAULT_LOGIN_ATTEMPT_EXPIRATION')); // decay minutes

            return $this->sendFailedLoginResponse($request);
        } catch (\Exception $e) {
            if (authUser() != null) {
                clearRoleCache(authUser());
                $this->guard()->logout();
            }
            throw new CustomGenericException($e->getMessage());
        }
    }

    public function loginType(Request $request)
    {
        $login_type = filter_var($request->input('email'), FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'username';

        $request->merge([
            $login_type => $request->input('email'),
        ]);

        return [
            $login_type => $request->get($login_type),
            'password' => $request->get('password'),
        ];
    }

    public function createLoginLog($request)
    {
        $client = new GuzzleHttp\Client(['base_uri' => Config::get('constants.API_URL')]);
        $res = $client->request('GET', '/json/' . $request->ip());
        $ipResponse = json_decode($res->getBody());

        if ($ipResponse->status == 'fail') {
            $ipResponse = '';
        }

        return Loginlogs::create([
            'user_id' => authUser()->id,
            'ip' => !empty($ipResponse) ? $ipResponse->query : Config::get('constants.IP_ADDRESS'),
            'city' => !empty($ipResponse) ? $ipResponse->city : 'Kathmandu',
            'country' => !empty($ipResponse) ? $ipResponse->country : 'Nepal',
            'isp' => !empty($ipResponse) ? $ipResponse->isp : 'Vianet Communications Pvt.',
            'lat' => !empty($ipResponse) ? $ipResponse->lat : '27.7167',
            'lon' => !empty($ipResponse) ? $ipResponse->lon : '85.3167',
            'timezone' => !empty($ipResponse) ? $ipResponse->timezone : 'Asia/Kathmandu',
            'region_name' => !empty($ipResponse) ? $ipResponse->regionName : 'Central Region',
        ]);
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearAttempts($request);

        if ($response = $this->authenticated($request, $this->guard()->user())) {
            return $response;
        }

      //  $this->createOrUpdateLanguageTranslationsDB();

        if (authUser()->is_2fa_enabled) {
            $this->twoFa();
            return redirect('/' . getSystemPrefix() . '/login/verify');
        }

        if ($request->has('redirect')) {
            return redirect('/' . getSystemPrefix() . $request->redirect);
        }

        return redirect('/' . getSystemPrefix() . '/home');
    }

    public function logout(Request $request)
    {
        if (authUser() != null) {
            clearRoleCache(authUser());
        }
        $this->guard()->logout();
        $request->session()->invalidate();

        return redirect(getSystemPrefix() . '/login')->withErrors(['alert-success' => 'Successfully logged out!']);
    }

    public function twoFa()
    {
        session()->forget('verification_code');
        $verificationCode = random_int(100000, 999999);

        session()->put('verification_code', $verificationCode);
        try {
            $user = authUser();
            $twoFactorExpireTime = Carbon::now()->addMinutes(Config::get('constants.DEFAULT_TWO_FA_EXPIRATION'))
                ->format('Y-m-d H:i:s');

            $user->update([
                'two_fa_expiry_time' => $twoFactorExpireTime
            ]);

            Mail::to($user->email)->send(new TwoFAEmail(authUser()));
        } catch (\Exception $e) {
            throw new CustomGenericException($e->getMessage());
        }
    }


    function createOrUpdateLanguageTranslationsDB()
    {
        $arrayT = [];
        $directory = resource_path('lang');
        if (!is_dir($directory)) {
            \File::makeDirectory($directory, $mode = 0755, true);
        }

        $langShortCodes = Language::pluck('language_code')->toArray();

        foreach ($langShortCodes as $lang) {
            $jsonFileName = "{$lang}.json";
            $jsonFilePath = "{$directory}/{$jsonFileName}";
            if (file_exists($jsonFilePath)) {
                $existingContent = file_get_contents($jsonFilePath);
                $arrayT[$lang] = json_decode($existingContent, true);
            }
        }

        $mergedArray = [];

        foreach ($arrayT[$langShortCodes[0]] as $key => $value) {
            $translations = [];

            foreach ($langShortCodes as $language) {
                $translations[$language] = $arrayT[$language][$key];
            }

            $mergedArray[$key] = $translations;
        }

        foreach ($mergedArray as $lanKey => $value) {
            $item = Locale::where('key', $lanKey)->first();

            if (!$item) {
                Locale::create([
                    'key' => $lanKey,
                    'text' => $value,
                ]);
            }
        }

        return $arrayT;
    }


    public
    function formatText($data, $heading)
    {
        $arrayT = [];
        foreach ($data as $key => $value) {
            $arrayT[$heading[$key]] = $value;
        }
        dd($arrayT);
        return $arrayT;
    }
}
