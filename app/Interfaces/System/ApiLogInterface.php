<?php

namespace App\Interfaces\System;

interface ApiLogInterface
{
    public function getAllData($data, $selectedColumns = [], $pagination = true);
}
