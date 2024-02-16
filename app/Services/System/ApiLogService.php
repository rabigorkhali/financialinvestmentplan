<?php

namespace App\Services\System;

use App\Exceptions\CustomGenericException;
use App\Exports\ApiLogExport;
use App\Repositories\System\ApiLogRepository;
use App\Services\Service;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class ApiLogService extends Service
{
    public function __construct(private readonly ApiLogRepository $logRepository)
    {
        parent::__construct($logRepository);
    }

    public function downloadExcel($request)
    {
        $data = $this->repository->getAllData($request, [], false);

        if ($data->isEmpty()) {
            throw new CustomGenericException('No records found.');
        }
        $fileName = 'apiLogs' . Carbon::now()->format('Ymd') . '.xlsx';

        return Excel::download(new ApiLogExport($data), $fileName);
    }
}
