<?php

namespace App\Services\System;

use App\Exceptions\CustomGenericException;
use App\Exceptions\UnauthorizedException;
use App\Http\Requests\system\profileChangePasswordRequest;
use App\Mail\system\ProfileUpdateEmail;
use App\Repositories\System\UserRepository;
use App\Services\Service;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class PasswordChangeService extends Service
{
    public function __construct(UserRepository $user)
    {
        parent::__construct($user);
    }

    public function indexPageData($data)
    {
        return [
            'item' => $this->repository->itemByIdentifier(authUser()->id),
        ];
    }

    public function update(ProfileChangePasswordRequest $request, $id)
    {
        try {
            if (authUser()->id != $id) {
                throw new UnauthorizedException('Unauthorized action performed.');
            }
            $data = $request->only('password');
            $user = $this->repository->itemByIdentifier($id);
            $logMsg = "New Password was <strong>created</strong> by {$user->name}";
            storeLog($user, $logMsg);

            $user->update([
                'password' => Hash::make($data['password']),
            ]);
            Mail::to($user->email)->send(new ProfileUpdateEmail($user));
            return $user;
        } catch (\Exception $e) {
            throw new CustomGenericException($e->getMessage());
        }
    }
}
