<?php

namespace App\Services\System;

use App\Exceptions\CustomGenericException;
use App\Exceptions\NotDeletableException;
use App\Repositories\System\RoleRepository;
use App\Repositories\System\UserRepository;
use App\Services\Service;

class RoleService extends Service
{
    public function __construct(RoleRepository $roleRepository,
                               public UserRepository $userRepository)
    {
        parent::__construct($roleRepository);
    }

    public function indexPageData($request)
    {
        return [
            'items' => $this->repository->getAllData($request),
            'roles' => $this->repository->getRoles()
        ];
    }

    public function store($request)
    {
        $data = $request->except('_token');
        $data['permissions'] = $this->repository->mapPermission($request->permissions);

        return $this->repository->create($data);
    }

    public function editPageData($request, $id)
    {
        $role = $this->repository->itemByIdentifier($id);

        return [
            'item' => $role,
        ];
    }

    public function update($request, $id)
    {
        $data = $request->except('_token');
        $data['permissions'] = $this->repository->mapPermission($data['permissions']);
        $checkRoleUsers = $this->userRepository->getByRolePivotRoleUser($id);

        $this->repository->update($data, $id);
        $role = $this->repository->itemByIdentifier($id);
        if ($checkRoleUsers != null || isset($checkRoleUsers)) {
            foreach ($checkRoleUsers as $user) {
                if (getRoleCache($user) != null) {
                    clearRoleCache($user);
                    setRoleCache($user);
                }
            }
        }

        return $role;
    }

    public function delete($request, $id)
    {
        try {
            $role = $this->repository->itemByIdentifier($id);
            if ($role->users->count() > 0) {
                throw new NotDeletableException('The role is associated to the users.');
            }

            return $role->delete();
        } catch (\Exception $e) {
            throw new CustomGenericException($e->getMessage());
        }
    }
}
