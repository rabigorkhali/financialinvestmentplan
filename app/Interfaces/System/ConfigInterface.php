<?php

namespace App\Interfaces\System;

interface ConfigInterface
{
    public function getAllData($data, $selectedColumns = [], $pagination = true);
    
    public function create($data);    

    public function update($config, $data);

    public function delete($request,$id);
}
