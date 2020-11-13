<?php


namespace App\Http\Controllers;


use App\Jobs\ExampleJob;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class ExampleController extends Controller
{
    public function __construct()
    {
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @link https://lumen.laravel.com/docs/5.1/queues#failed-job-events
     */
    public function testJob($id)
    {
        Log::info(Carbon::now());
        $job = (new ExampleJob($id))->delay(1);
        $this->dispatch($job);
        return response()->json('Job has finished');
    }
}