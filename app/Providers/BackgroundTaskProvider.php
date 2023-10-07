<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\BackgroundTask;

class BackgroundTaskProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->bind(BackgroundTask::class, Task::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
