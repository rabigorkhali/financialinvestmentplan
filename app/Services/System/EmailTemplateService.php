<?php

namespace App\Services\System;


use App\Repositories\System\EmailRepository;
use App\Services\Service;

class EmailTemplateService extends Service
{
    public function __construct(EmailRepository $emailRepository)
    {
        parent::__construct($emailRepository);
    }

    public function getAllData($data, $selectedColumns = [], $pagination = true)
    {
        return $this->repository->getAllData($data);
    }

    public function indexPageData($request)
    {
        return [
            'items' => $this->getAllData($request)
        ];
    }

    public function store($request)
    {
        return $this->repository->create($request);
    }

    public function editPageData($request, $id)
    {
        $email = $this->repository->itemByIdentifier($id);
        return [
            'item' => $email,
        ];
    }

    public function update($request, $id)
    {
        return $this->repository->update($request, $id);
    }
    public function delete($request, $id)
    {
        return $this->repository->delete($request,$id);
    }
}
