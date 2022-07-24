<?php

namespace App\Console\Commands;

// Classes
use App\Classes\DataServices\CareQualityData AS CareQualityDataService;
use App\Models\CareQualityData;
// Framework
use Illuminate\Console\Command;

class SyncCareQualityData extends Command
{

    protected $isRemoteAPIStatus;

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
     * Construct for pre-checks.
     *
     */
    public function __construct()
    {
        parent::__construct(); // <- Just a requirement to use construct in a command.
        $this->isRemoteAPIStatus = (new CareQualityDataService())->checkRemoteAPIStatus(); // <- Only used once so just initialized it inline.
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        // Doing something creative here.
        // Will first check the first process is complete and then run the second process.

        if(CareQualityDataService::syncLatestProviders(CareQualityDataService::getApiLimits(), $this->isRemoteAPIStatus))
        {
            dd("Next loop through the already stored data and store the relating data from the API endpoint using the product_id");

            // Pace holder for the outlined above.
            CareQualityDataService::syncStoredProviderDetails(); //<-- See info inside the function, stopped here as its 2am and im pooped :).
        }
    }

}
