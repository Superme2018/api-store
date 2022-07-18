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
    protected $description = 'Retrieve any new records that are cont currently stored in the database.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Quick check to see if the class is hooked up.
        CareQualityDataService::dataSync();
    }
}
