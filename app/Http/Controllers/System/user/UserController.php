<?php

namespace App\Http\Controllers\System\user;

use App\Http\Controllers\System\ResourceController;
use App\Http\Requests\system\resetPassword;
use App\Services\System\UserService;

class UserController extends ResourceController
{
    public function __construct(private readonly UserService $userService)
    {
        parent::__construct($userService);
    }

    public function storeValidationRequest()
    {
        return 'App\Http\Requests\system\userRequest';
    }

    public function moduleName()
    {
        return 'users';
    }

    public function viewFolder()
    {
        return 'system.user';
    }

    public function changePassword()
    {
        if (authUser()->password_resetted == 0) {
            $data['title'] = 'Please change your password for security reasons.';
            $data['email'] = authUser()->email;
            $data['token'] = encrypt(authUser()->token);
            $data['buttonText'] = 'Change Password';

            return view('system.auth.setPassword', $data);
        } else {
            return redirect(getSystemPrefix().'/home');
        }
    }

    public function passwordReset(resetPassword $request)
    {
        $this->service->resetPassword($request);

        return redirect($this->getUrl())->withErrors(['success' => 'Password successfully updated.']);
    }
}
