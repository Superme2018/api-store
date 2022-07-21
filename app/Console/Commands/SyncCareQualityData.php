<?php

namespace App\Console\Commands;

// Classes
use App\Classes\DataServices\CareQualityData AS CareQualityDataService;

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
        $this->isRemoteAPIStatus = CareQualityDataService::checkRemoteAPIStatus();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        CareQualityDataService::syncLatestData(CareQualityDataService::getApiLimits(), $this->isRemoteAPIStatus);
    }

}
