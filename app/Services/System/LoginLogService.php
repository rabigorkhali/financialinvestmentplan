<?php

namespace App\Services\System;

use App\Exceptions\CustomGenericException;
use App\Exports\LoginLogExport;
use App\Repositories\System\LoginLogRepository;
use App\Services\Service;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use \PDF;

class LoginLogService extends Service
{
    public function __construct(private readonly LoginLogRepository $loginLogRepository)
    {
        parent::__construct($loginLogRepository);
    }

    public function downloadExcel($request)
    {
        $data = $this->repository->getAllData($request, [], false);

        if ($data->isEmpty()) {
            throw new CustomGenericException('No records found.');
        }
        $fileName = 'loginLogs' . Carbon::now()->format('Ymd') . '.xlsx';

        return Excel::download(new LoginLogExport($data), $fileName);
    }
}
