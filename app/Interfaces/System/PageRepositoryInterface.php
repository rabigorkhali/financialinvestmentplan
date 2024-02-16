<?php

namespace App\Interfaces\System;

interface PageRepositoryInterface
{
    public function getAllData($data = null, $selectedColumns = [], $pagination = true);

    public function createPage($userData);

    public function updatePage($id, $userData);

    public function deletePage($id);

    public function changeStatus($id);
}
