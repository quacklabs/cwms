<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\AppModels\Task;
use Illuminate\Support\Facades\Log;
use App\Events\TaskCompletedEvent;
// use Pusher\Pusher;

use App\Traits\Notifies;

class TaskMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle($job, $next) {

        $job->trackedJob = Task::where('trackable_id', $job->job->getJobId())->first();
        // dd($job->job);
        $job->trackedJob->markAsStarted();
        $response = $next($job);

        if ($job->job->isReleased()) {
            $job->trackedJob->markAsRetrying();

        } else {
            if(method_exists($job, 'sendNotification')){
                $job->sendNotification($job->trackedJob, $job->name);
            } else {
                Log::debug("trait not found");
            }
            // TaskCompletedEvent::dispatch(, string $action, array $data = []);
            $job->trackedJob->markAsFinished($response);
        }
        return $response;
    }
}
