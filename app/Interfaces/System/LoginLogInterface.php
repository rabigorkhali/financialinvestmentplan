<?php

namespace App\Interfaces\System;

interface LoginLogInterface
{
    public function getAllData($data, $selectedColumns = [], $pagination = true);

}
