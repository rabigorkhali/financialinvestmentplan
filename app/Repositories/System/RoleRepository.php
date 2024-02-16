<?php

namespace App\Repositories\System;

use App\Interfaces\OpenInterface;
use App\Interfaces\System\RoleInterface;
use App\Model\Role;
use App\Repositories\Repository;
use App\RoleUser;
use App\User;

class RoleRepository extends Repository implements RoleInterface
{
    public function __construct(private readonly Role $role)
    {
        parent::__construct($role);
    }

    public function getAllData($data, $selectedColumns = [], $pagination = true)
    {
        $query = $this->query();

        if (isset($data->keyword) && $data->keyword !== null) {
            $query->where('name', 'ILIKE', '%' . $data->keyword . '%');
        }
        if (count($selectedColumns) > 0) {
            $query->select($selectedColumns);
        }
        if ($pagination) {
            return $query->orderBy('id', 'DESC')->with('users')->paginate(PAGINATE);
        }

        return $query->orderBy('id', 'DESC')->with('users')->get();
    }

    public function mapPermission($permissions)
    {
        $mappedPermissions = [];
        foreach ($permissions as $permission) {
            $decoded = json_decode($permission);
            if (is_array($decoded)) {
                foreach ($decoded as $per) {
                    $mappedPermissions[] = $per;
                }
            } else {
                $mappedPermissions[] = $decoded;
            }
        }

        return $mappedPermissions;
    }

    public function getRoles()
    {
        return $this->model->orderBy('name', 'ASC')->pluck('name', 'id')->toArray();
    }

//    public function getByRolePivotRoleUser($userId)
//    {
//        return $this->roleUser->where('user_id', $userId)->pluck('role_id')->toArray();
//    }
}
