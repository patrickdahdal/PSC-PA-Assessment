<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Assessment;

class RemoveAssessment extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'removeAssessmentJob:RemoveAssessment';

    /**
     * Remove assessment lasted 3 months.
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
            Assessment::where('updated_at', '<', Carbon::now()->subMonths(3))->delete();
        } catch (\Throwable $e) {
            Log::error('Cron Currency : ' . $e->getMessage());
        }
    }
}
