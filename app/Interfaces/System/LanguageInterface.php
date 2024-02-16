<?php

namespace App\Interfaces\System;

interface LanguageInterface
{
    public function getAllData($data, $selectedColumns = [], $pagination = true);

    public function create($request);

    public function delete($request, $id);

    public function getLanguages();
}
