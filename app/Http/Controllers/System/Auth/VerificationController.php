<?php

namespace App\Http\Controllers\System\Auth;

use App\Exceptions\ResourceNotFoundException;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Mail\system\TwoFAEmail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Traits\CustomThrottleRequest;
use App\Exceptions\CustomGenericException;
use App\Http\Requests\system\verifyLoginRequest;
use Config;

class VerificationController extends Controller
{
    use CustomThrottleRequest;

    public function showVerifyPage()
    {
        return view('system.auth.verify');
    }

    public function sendAgain(Request $request)
    {
        try {
            if (
                method_exists($this, 'hasTooManyAttempts') &&
                $this->hasTooManyAttempts($request, Config::get('constants.DEFAULT_TWO_FA_THROTTLE_LIMIT')) // maximum attempts can be set by passing parameter $attempts=
            ) {
                $this->customFireLockoutEvent($request);

                return $this->customLockoutResponse($request);
            }

            $user = authUser();

            $this->incrementAttempts($request, Config::get('constants.DEFAULT_TWO_FA_THROTTLE_EXPIRATION')); // maximum decay minute can be set by passing parameter $minutes=

            $checkExpiryDate = now()->format('Y-m-d H:i:s') > $user->two_fa_expiry_time;

            if (!$checkExpiryDate) {
                throw new ResourceNotFoundException("The previous code is still valid.");
            }

            session()->forget('verification_code');
            $verificationCode = random_int(100000, 999999);

            session()->put('verification_code', $verificationCode);
            try {
                $twoFactorExpireTime = Carbon::now()->addMinutes(Config::get('constants.DEFAULT_TWO_FA_REQUEST_EXPIRATION')) // in minutes
                    ->format('Y-m-d H:i:s');

                $user->update([
                    'two_fa_expiry_time' => $twoFactorExpireTime
                ]);

                Mail::to($user->email)->send(new TwoFAEmail(authUser()));
            } catch (\Exception $e) {
                throw new CustomGenericException($e->getMessage());
            }

            return back()->withErrors(['alert-success' => 'Verification code sent to your email.']);
        } catch (\Exception $e) {
            throw new CustomGenericException($e->getMessage());
        }
    }

    public function verify(verifyLoginRequest $request)
    {
        try {
            if (
                method_exists($this, 'hasTooManyAttempts') &&
                $this->hasTooManyAttempts($request, Config::get('constants.DEFAULT_TWO_FA_THROTTLE_LIMIT')) // maximum attempts can be set by passing parameter $attempts=
            ) {
                $this->customFireLockoutEvent($request);

                return $this->customLockoutResponse($request);
            }

            $this->incrementAttempts($request, Config::get('constants.DEFAULT_TWO_FA_THROTTLE_EXPIRATION')); // maximum decay minute can be set by passing parameter $minutes=

            $code = $request->code;
            if (session()->get('verification_code') == $code) {
                session()->put('request_verification_code', $code);

                return redirect('/' . getSystemPrefix() . '/home');
            } else {
                return back()->withErrors(['alert-danger' => 'Incorrect Verification Code.']);
            }
        } catch (\Exception $e) {
            throw new CustomGenericException($e->getMessage());
        }
    }
}
