<?php

namespace App\Http\Controllers\System\profile;

use App\Http\Controllers\Controller;
use App\Http\Controllers\System\ResourceController;
use App\Services\System\PasswordChangeService;
use App\Services\System\ProfileService;

class PasswordChangeController extends ResourceController
{
    public function __construct(private readonly PasswordChangeService $passwordChangeService)
    {
        parent::__construct($passwordChangeService);
    }

    public function storeValidationRequest()
    {
        return 'App\Http\Requests\system\ProfileChangePasswordRequest';
    }

    public function moduleName()
    {
        return 'profile-change-password';
    }

    public function viewFolder()
    {
        return 'system.profile.changePassword';
    }
}
