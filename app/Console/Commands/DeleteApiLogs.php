<?php

namespace App\Console\Commands;

use App\Model\ApiLog;
use App\Model\ErrorLog;
use App\Model\Loginlogs;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DeleteApiLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:logs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete (API,Error and Login) Logs';

    public function __construct(private readonly ApiLog    $apiLog,
                                private readonly ErrorLog  $errorLog,
                                private readonly Loginlogs $loginlog)
    {
        parent::__construct($apiLog);
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $oneYearAgo = Carbon::now()->subYear();

        $this->apiLog->where('created_at', '<', $oneYearAgo)->delete();
        $this->errorLog->where('created_at', '<', $oneYearAgo)->delete();
        $this->loginlog->where('created_at', '<', $oneYearAgo)->delete();
        $this->info('(API,Error and Login) Logs has been deleted.');
    }
}
