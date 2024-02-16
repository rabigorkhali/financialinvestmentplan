<?php

namespace App\Http\Controllers\System\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\System\UserService;
use Illuminate\Support\Facades\Hash;
use App\Exceptions\CustomGenericException;
use App\Http\Requests\system\setResetRequest;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    public function __construct(private readonly UserService $user)
    {
    }

    public function showSetResetForm(Request $request)
    {
        try {
            $data['title'] = 'Set Password';
            if ($request->route()->getName() == 'reset.password') {
                $data['title'] = 'Reset Password';
            }

            $this->user->findByEmailAndToken($request->email, $request->token);

            $data['email'] = $request->email;
            $data['token'] = $request->token;

            return view('system.auth.setPassword', $data);
        } catch (\Exception $e) {
            throw new CustomGenericException('The provided link has already expired.');
        }
    }

    public function handleSetResetPassword(setResetRequest $request)
    {
        if ($this->setResetPassword($request)) {
            $redirect = redirect(getSystemPrefix() . '/login');
            $msg = ['alert-success' => 'Password has been successfully set.'];
        } else {
            $redirect = back();
            $msg = ['alert-danger' => 'Please provide the new password.'];
        }

        return $redirect->withErrors($msg);
    }

    public function setResetPassword($request)
    {
        try {
            $user = $this->user->findByEmailAndToken($request->email, $request->token);

            $check = $this->checkOldPasswords($user, $request);

            if ($check) {
                $password = Hash::make($request->password);
                if ($user->userPasswords->count() < 3) {
                    $user->userPasswords()->create(['password' => $password]);
                }
                $user->update([
                    'password' => $password,
                    'password_resetted' => 1,
                    'token' => $this->user->generateToken(24),
                    'expiry_datetime' => null
                ]);

                return true;
            } else {
                return false;
            }
        } catch (\Exception $e) {
            throw new CustomGenericException($e->getMessage());
        }
    }

    public function checkOldPasswords($user, $request)
    {
        $oldPasswords = $user->userPasswords()->get();
        $check = true;
        foreach ($oldPasswords as $oldPassword) {
            if (Hash::check($request->password, $oldPassword->password)) {
                $check = false;
                break;
            }
        }
        return $check;
    }
}
