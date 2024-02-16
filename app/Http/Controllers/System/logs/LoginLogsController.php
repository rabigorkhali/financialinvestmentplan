<?php

namespace App\Http\Controllers\System\logs;

use App\Http\Controllers\System\ResourceController;
use App\Services\System\LoginLogService;
use Illuminate\Http\Request;

class LoginLogsController extends ResourceController
{
    public function __construct(private readonly LoginLogService $loginService)
    {
        parent::__construct($loginService);
    }

    public function moduleName()
    {
        return 'login-logs';
    }

    public function viewFolder()
    {
        return 'system.loginLogs';
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
