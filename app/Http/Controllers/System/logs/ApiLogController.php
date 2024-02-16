<?php

namespace App\Http\Controllers\System\logs;

use App\Http\Controllers\System\ResourceController;
use App\Services\System\ApiLogService;
use Illuminate\Http\Request;

class ApiLogController extends ResourceController
{
    public function __construct(private readonly ApiLogService $logService)
    {
        parent::__construct($logService);
    }

    public function moduleName()
    {
        return 'api-logs';
    }

    public function viewFolder()
    {
        return 'system.apiLog';
    }

    public function downloadExcel(Request $request)
    {
        try {
            $this->service->downloadExcel($request);
            return redirect()->back()->withErrors(['success' => 'Successfully downloaded.']);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['alert-danger' => $e->getMessage()]);
        }
    }
}
