<?php

namespace App\Http\Controllers\System\systemConfig;

use App\Http\Controllers\System\ResourceController;
use App\Services\System\ConfigService;

class configController extends ResourceController
{
    public function __construct(private readonly ConfigService $configService)
    {
        parent::__construct($configService);
    }

    public function storeValidationRequest()
    {
        return 'App\Http\Requests\system\ConfigRequest';
    }

    public function moduleName()
    {
        return 'configs';
    }

    public function viewFolder()
    {
        return 'system.config';
    }
}
