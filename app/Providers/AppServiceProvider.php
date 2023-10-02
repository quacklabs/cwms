<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Collection;
use App\Console\Commands\MakeServiceCommand;
use App\Console\Commands\MakeInterfaceCommand;
use App\Console\Commands\ProcessQueue;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->commands([
            MakeServiceCommand::class,
            MakeInterfaceCommand::class,
            ProcessQueue::class
        ]);
        
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        
    }
}
