<?php

namespace App\Interfaces\System;

interface LogInterface
{
    public function getAllData($data, $selectedColumns = [], $pagination = true);
}
