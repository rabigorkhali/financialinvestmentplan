<?php

namespace App\Interfaces;

interface OpenInterface
{
    public function getAllData($data, $selectedColumns = [], $pagination = true);

    public function create($data);  

    public function update($id, $data);

    public function delete($request,$id);
}
