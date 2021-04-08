<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\CustomerResetPassword;

class RemoveCustomerResetPassword extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'removeCustomerResetPasswordJob:RemoveCustomerResetPassword';

    /**
     * Remove customer reset password lasted 60 mins.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            CustomerResetPassword::where('updated_at', '<', Carbon::now()->subMinutes(60))->delete();
        } catch (\Throwable $e) {
            Log::error('Cron Currency : ' . $e->getMessage());
        }
    }
}
