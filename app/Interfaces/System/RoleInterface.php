<?php

namespace App\Interfaces\System;

interface RoleInterface
{
    public function getAllData($data, $selectedColumns = [], $pagination = true);

    public function create($data);

    public function update($id, $data);

    public function delete($request, $id);

    public function mapPermission($permissions);

    public function getRoles();
}
