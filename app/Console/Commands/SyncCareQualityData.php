<?php

namespace App\Console\Commands;


// Classes
use App\Classes\DataServices\CareQualityData AS CareQualityDataService;

// Framework
use Illuminate\Console\Command;

class SyncCareQualityData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:sync_care_quality_data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Retrieve any new records that are not currently stored in the database.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        if(!$apiLimits = CareQualityDataService::getApiLimits())
        {
            dd("Just a quick check to make sure we have data. Even though null has not been handled yet.");
        }

        CareQualityDataService::getLatestData($apiLimits);
    }

}
