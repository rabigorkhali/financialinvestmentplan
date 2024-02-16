<?php

namespace App\Repositories\System;

use App\Interfaces\OpenInterface;
use App\Repositories\Repository;
use App\MailTest;

class MailRepository extends Repository implements OpenInterface
{
    public function __construct(private readonly MailTest $mailTest)
    {
        $this->model = $mailTest;
    }
}
