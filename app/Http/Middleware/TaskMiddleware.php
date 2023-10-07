<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\AppModels\Task;
use Illuminate\Support\Facades\Log;

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
            $job->trackedJob->markAsFinished($response);
        }
        return $response;
    }
}
