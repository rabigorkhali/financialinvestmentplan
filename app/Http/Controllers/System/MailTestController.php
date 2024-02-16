<?php

namespace App\Http\Controllers\System;

use App\Exceptions\CustomGenericException;
use App\Http\Requests\system\testMailRequest;
use App\Mail\system\TestMail;
use App\Services\System\MailService;
use Illuminate\Support\Facades\Mail;

class MailTestController extends ResourceController
{
    public function __construct(private readonly MailService $mailService)
    {
        parent::__construct($mailService);
    }

    public function moduleName()
    {
        return 'mail-test';
    }

    public function viewFolder()
    {
        return 'system.mailtest';
    }

    public function sendEmail(testMailRequest $request)
    {
        try {
            Mail::to($request->toemail)->send(new TestMail($request->all()));
            return redirect()->back()->withErrors(['success' => 'Mail Sent successfully .']);
        } catch (\Exception $e) {
            throw new CustomGenericException($e->getMessage());
        }
    }
}
