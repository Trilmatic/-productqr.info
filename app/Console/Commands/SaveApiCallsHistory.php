<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Threshold;
use App\Models\ApiCallsHistory;
use Carbon\Carbon;

class SaveApiCallsHistory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'apicalls:save';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Saves api calls history and resets the api calls thresholds';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $thresholds = Threshold::all();
        foreach ($thresholds as $threshold) {
            $history = new ApiCallsHistory([
                'user_id' => $threshold->user_id,
                'api_calls_count' => $threshold->api_calls_count,
                'api_calls_limit' => $threshold->api_calls_limit,
            ]);
            $history->save();
            $threshold->api_calls_count = 0;
            $threshold->save();
        }
        return Command::SUCCESS;
    }
}
