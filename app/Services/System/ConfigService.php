<?php

namespace App\Services\System;

use App\Exceptions\NotDeletableException;
use App\Repositories\System\ConfigRepository;
use App\Services\Service;
use App\Traits\ImageTrait;

class ConfigService extends Service
{
    use ImageTrait;

    public $dir = '/uploads/config';

    public function __construct(ConfigRepository $configRepository)
    {
        parent::__construct($configRepository);
    }

    public function getAllData($data, $selectedColumns = [], $pagination = true)
    {
        return $this->repository->getAllData($data);
    }

    //config type key value pair
    public function configTypeOptions()
    {
        $mapped = [];
        foreach (configTypes() as $config) {
            $mapped[$config] = ucfirst($config);
        }

        return $mapped;
    }

    public function indexPageData($request)
    {
        return [
            'items' => $this->getAllData($request),
            'types' => $this->configTypeOptions()
        ];
    }

    public function store($request)
    {
        $data = $request->except('_token');
        if (strtolower($request->type) == 'file') {
            $data['value'] = $this->uploadImage($this->dir, 'value');
        }
        return $this->repository->create($data);
    }

    public function update($request, $id)
    {
        $data = $request->except('_token');

        $config = $this->repository->itemByIdentifier($id);
        $value = str_replace(' ', '_', $config->label);
        $data['value'] = $data[$value];
        unset($data[$value]);

        if (strtolower($config->type) == 'file') {
            $this->removeImage($this->dir, $config->value);
            $data['value'] = $this->uploadConfigImage($this->dir, $data['value']);
        }

        $this->repository->update($config, $data);
        setConfigCookie();

        return $config = $this->repository->itemByIdentifier($id);
    }

    public function delete($request, $id)
    {
        $config = $this->repository->itemByIdentifier($id);
        if (in_array($id, [1, 2, 3])) {
            throw new NotDeletableException;
        }
        if (strtolower($config->type) == 'file') {
            $this->removeImage($this->dir, $config->value);
        }
        return $this->repository->delete($config, $id);
    }
}
