<?php

namespace App\Http\Controllers\System\systemConfig;

use App\Http\Controllers\System\ResourceController;
use App\Services\System\EmailTemplateService;

class emailTemplateController extends ResourceController
{
    public function __construct(private readonly EmailTemplateService $emailtemplateService)
    {
        parent::__construct($emailtemplateService);
    }

    public function storeValidationRequest()
    {
        return 'App\Http\Requests\system\emailTemplateRequest';
    }

    public function moduleName()
    {
        return 'email-templates';
    }

    public function viewFolder()
    {
        return 'system.email-template';
    }
}
