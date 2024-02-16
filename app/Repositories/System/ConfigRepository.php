<?php

namespace App\Repositories\System;

use App\Interfaces\OpenInterface;
use App\Interfaces\System\ConfigInterface;
use App\Model\Config;
use App\Repositories\Repository;

class ConfigRepository extends Repository implements ConfigInterface
{
  public function __construct(private readonly Config $config)
  {
    parent::__construct($config);
  }

  public function getAllData($data, $selectedColumns = [], $pagination = true)
  {
    $query = $this->query();

    if (isset($data->keyword) && $data->keyword !== null) {
      $query->where('label', 'ILIKE', '%' . $data->keyword . '%');
    }
    if (count($selectedColumns) > 0) {
      $query->select($selectedColumns);
    }
    if ($pagination) {
      return $query->orderBy('id', 'ASC')->paginate(PAGINATE);
    }

    return $query->orderBy('id', 'ASC')->get();
  }
  public function create($data)
  {
    return $this->model->create($data);
  }

  public function update($config, $data)
  {
    return  $config->update($data);
  }

  public function delete($config, $id)
  {
    return $config->delete();
  }
}
