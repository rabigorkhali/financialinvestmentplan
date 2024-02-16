<?php

namespace App\Interfaces\System;

interface ErrorLogInterface
{
    public function getAllData($data, $selectedColumns = [], $pagination = true);
}
