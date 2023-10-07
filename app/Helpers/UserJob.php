<?php

namespace App\Helpers;
use Illuminate\Bus\Dispatcher;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\QueueManager;
use Junges\TrackableJobs\Models\TrackedJob;
// use ;

class UserJob {

    // public $id;
    public $user_id;

    // public function __construct() {
        
    // }


    // public function dispatch($command){
    //     // Check if the job has a 'userId' property
    //     if (property_exists($command, 'user_id') && !$command->user_id) {

    //         $command->user_id = auth()->user()->id() ?? 0; // Set userId if not already set
    //     }

    //     if (!is_null($command->user_id)) {
    //         DB::table('jobs')
    //             ->where('id', $command->getJobId())
    //             ->update(['user_id' => $this->user_id]);
    //     }

    //     return parent::dispatch($command);
    // }
}