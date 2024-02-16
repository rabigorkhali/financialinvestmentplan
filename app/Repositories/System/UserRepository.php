<?php

namespace App\Repositories\System;

use App\Exceptions\ResourceNotFoundException;
use App\Interfaces\System\UserRepositoryInterface;
use App\Repositories\Repository;
use App\RoleUser;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserRepository extends Repository implements UserRepositoryInterface
{
    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    public function getAllData($data, $selectedColumns = [], $pagination = true)
    {
        $query = $this->query();

        if (isset($data->keyword)) {
            $query->where(function ($q) use ($data) {
                $q->orwhere('name', 'ILIKE', '%' . $data->keyword . '%')
                    ->orwhere('username', 'ILIKE', '%' . $data->keyword . '%')
                    ->orwhere('email', 'ILIKE', '%' . $data->keyword . '%');
            });
        }

        if (isset($data->role) && $data->role !== null) {
            $query->where('role_id', $data->role);
        }

        if (count($selectedColumns) > 0) {
            $query->select($selectedColumns);
        }

        if ($pagination) {
            return $query->orderBy('id', 'DESC')->with('role')->paginate(PAGINATE);
        }

        return $query->orderBy('id', 'DESC')
            ->with('role')->get();
    }

    public function create($data)
    {
        return $this->model->create($data);
    }

    public function update($user, $data)
    {
        return $user->update($data);
    }

    public function delete($request, $id)
    {
        $user = $this->itemByIdentifier($id);
        return $user->delete();
    }

    public function generateToken($length)
    {
        $token = generateToken($length);
        $check = $this->model->where('token', $token)->exists();
        if ($check) {
            $token = generateToken($length);
        }

        return $token;
    }

    public function resetPassword($request)
    {
        $user = $this->itemByIdentifier($request->id);
        return $user->update([
            'password' => Hash::make($request->password),
        ]);
    }

    public function findByEmailAndToken($email, $decryptedToken)
    {
        return $this->model->where('email', $email)->where('token', $decryptedToken)->first();
    }

    public function findByEmail($email)
    {
        $user = $this->model->where('email', $email)->first();
        if (!isset($user)) {
            throw new ResourceNotFoundException("User doesn't exist in our system.");
        }
        return $user;
    }

    public function bulkUpdateUserByRole($roleId, $requestRole)
    {
        return $this->model->where('role_id', $roleId)->update(['role_id' => $requestRole]);
    }

    public function getByRolePivotRoleUser($roleId)
    {
        return $this->model->where('role_id', $roleId)->get();
    }

    public function pluckUsersWithIdAndName()
    {
        return $this->model->pluck('name', 'id')->toArray();
    }
}
