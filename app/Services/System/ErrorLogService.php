<?php

namespace App\Services\System;

use App\Exceptions\CustomGenericException;
use App\Exports\ErrorLogExport;
use App\Exports\LoginLogExport;
use App\Repositories\System\ErrorLogRepository;
use App\Services\Service;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

class ErrorLogService extends Service
{
    public function __construct(private readonly ErrorLogRepository $logRepository)
    {
        parent::__construct($logRepository);
    }

    public function downloadExcel($request)
    {
        $data = $this->repository->getAllData($request, [], false);
        if ($data) {
            throw new CustomGenericException('No records found.');
        }

        $fileName = 'errorLogs' . Carbon::now()->format('Ymd') . '.xlsx';

        return Excel::download(new ErrorLogExport($data), $fileName);
    }
}
