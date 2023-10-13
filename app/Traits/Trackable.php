<?php
namespace App\Traits;

use App\Models\AppModels\Task;
use Illuminate\Database\Eloquent\Model;
use App\Http\Middleware\TaskMiddleware;

use Throwable;

trait Trackable {
    public ?int $user_id;
    public ?int $model;
    public ?Task $trackedJob;
    public bool $notify = false;
    
    public function middleware(): array {
        return [new TaskMiddleware()];
    }

    // public function failed(Throwable $exception)
    // {
    //     $message = $exception->getMessage();
    //     $this->trackedJob = Task::where('trackable_id', $this->model)->first();
    //     if($this->trackedJob != null) {
    //         $this->trackedJob->markAsFailed($message);
    //     }
    // }
}