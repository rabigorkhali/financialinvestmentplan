<?php

namespace App\Services\System;

use App\Mail\system\TestMail;
use App\MailTest;
use App\Repositories\System\MailRepository;
use App\Services\Service;
use Illuminate\Support\Facades\Mail;

class MailService extends Service
{
    public function __construct(MailRepository $mailTest)
    {
        parent::__construct($mailTest);
    }

    public function sendMail($request)
    {
        return Mail::to($request->toemail)->send(new TestMail($request->all()));
    }
}
