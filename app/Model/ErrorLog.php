<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ErrorLog extends Model
{
    protected $fillable = ['ip', 'log_date', 'user_agent', 'request_endpoint', 'response_code', 'response_time', 'request_body', 'response_body'];
}
