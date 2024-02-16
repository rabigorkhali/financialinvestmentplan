<?php

namespace App\Services\System;

use App\Exceptions\CustomGenericException;
use App\Exceptions\UnauthorizedException;
use App\Http\Requests\system\profileChangePasswordRequest;
use App\Mail\system\PasswordResetEmail;
use App\Mail\system\ProfileUpdateEmail;
use App\Repositories\System\UserRepository;
use App\Services\Service;
use App\Traits\ImageTrait;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;


class ProfileService extends Service
{
    use ImageTrait;
    public $dir = '/uploads/profile';

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

    public function update($request, $id)
    {
        try {
            if (authUser()->id != $id) {
                throw new UnauthorizedException('Unauthorized action performed.');
            }

            $user = $this->repository->itemByIdentifier($id);
            $data = $request->only('name', 'username', 'email', 'contact', 'image');

            if (isset($request['image'])) {
                $this->removeImage($this->dir, $user->image);
                $data['image'] = $this->uploadImage($this->dir, 'image');
            }
            $this->repository->update($user, $data);

            Mail::to($user->email)->send(new ProfileUpdateEmail($user));
            return $user;
        } catch (\Exception $e) {
            throw new CustomGenericException($e->getMessage());
        }
    }
}
