<?php

namespace App\Repositories\System;


use App\Interfaces\System\LogInterface;
use App\Model\Log;
use App\Repositories\Repository;
use Carbon\Carbon;
use Config;

class LogRepository extends Repository implements LogInterface
{
  public function __construct(private readonly Log $log)
  {
    parent::__construct($log);
  }

  public function getAllData($data, $selectedColumns = [], $pagination = true)
  {
    $query = $this->query();
    if (count($selectedColumns) > 0) {
      $query->select($selectedColumns);
    }

      if (isset($data->keyword)) {
          $query->where(function ($q) use ($data) {
              $q->orwhere('log_name', 'ILIKE', '%' . $data->keyword . '%')
                  ->orwhereHas('user', function ($qu) use ($data) {
                      $qu->where('username', 'ILIKE', '%' . $data->keyword . '%');
                  });
          });
      }

    if (isset($data->from) && isset($data->to)) {
      $from = Carbon::createFromFormat('Y-m-d H:i:s', $data->from . ' 00:00:00');
      $to = Carbon::createFromFormat('Y-m-d H:i:s', $data->to . ' 23:59:00');
      $query->whereBetween('created_at', [$from, $to]);
    }
    if ($pagination) {
      return $query->orderBy('id', 'DESC')->with('user')->paginate(Config::get('constants.PAGINATION'));
    } else {
      return $query->get();
    }
  }
}
