<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

use App\Helpers\UserJob;
use App\Models\AppModels\Task;
use App\Models\Scheduled;

class JobCreatedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        // dd($event);
        $job = Scheduled::where('id', $event->id)->first();
        if($job) {
            Task::updateOrCreate(['trackable_id' => $job->id, 'user_id' => $event->job->user_id],
            [
            'trackable_type' => get_class($event->job),
            'name' => $event->job->name ?? "New Job"
        ]);
        }
        // $event->job->id = 
        
        //
        // $event->job->trackedJob = Task::updateOrCreate(['trackable_id' => $this->model->id ?? $this->model->uuid,
        // 'trackable_type' => $this->model->getMorphClass(),
        // 'name' => class_basename(static::class),],
        // []);
        // dd($event);
        // Log::debug($event);
        // Log::info('Job added to the queue', [
        //     'job_id' => $event->job->getJobId(),
        //     'payload' => $event->job->payload(),
        // ]);
    }

}
