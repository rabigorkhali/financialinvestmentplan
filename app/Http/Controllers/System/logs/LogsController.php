<?php

namespace App\Http\Controllers\System\logs;

use App\Http\Controllers\System\ResourceController;
use App\Services\System\LogService;

class LogsController extends ResourceController
{
    public function __construct(private readonly LogService $logService)
    {
        parent::__construct($logService);
    }

    public function moduleName()
    {
        return 'activity-logs';
    }

    public function viewFolder()
    {
        return 'system.log';
    }

    public function moduleToTitle()
    {
        return 'Audit Logs';
    }
}
