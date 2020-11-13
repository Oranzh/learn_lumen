<?php

namespace App\Jobs;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class ExampleJob extends Job
{
    protected $z;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($z)
    {
        $this->z = $z;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info('start----'.Carbon::now());

        if ($this->z == 5) {

            Log::emergency('Hello');
            throw new \Exception('Failed');
        }
        Log::info('end----'.Carbon::now());

        Log::info('Job Example');
    }

    public function failed()
    {
        Log::error('Job has failed'. $this->z);
    }


}
