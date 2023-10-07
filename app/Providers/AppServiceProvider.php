<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Bus\Dispatcher as DispatcherContract;

use App\Console\Commands\MakeServiceCommand;
use App\Console\Commands\MakeInterfaceCommand;
use App\Console\Commands\ProcessQueue;
use App\Helpers\QueueHandler;

use Illuminate\Support\Facades\Queue;

use Junges\TrackableJobs\Contracts\TrackableJobContract;
use App\Helpers\UserJob;
// use App\Helpers\QueueHandler;

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
        // $this->app->bind(TrackableJobContract::class, UserJob::class);
        // $this->app->singleton('queue', function ($app) {
        //     return $app->make(CustomQueue::class);
        // });
        // $this->app->bind(CustomQueue::class, function ($app) {
        //     return new CustomQueue(
        //         $app['db']->connection(), // You can customize the connection here
        //         $app['config']['queue.connections.database.table'],
        //         $app['config']['queue.connections.database.queue'],
        //         $app['config']['queue.connections.database.retry_after']
        //     );
        // });
        // $this->app->extend('queue.database', function () {
        //     return $this->app->make(CustomQueue::class);
        // });

        // $this->app->singleton(CustomQueue::class, function () {
        //     return new CustomQueue(
        //         $this->app['db']->connection(),
        //         $this->app['encrypter'],
        //         $this->app['config']['queue.connections.database']
        //     );
        // });
        // $this->app->alias(CustomQueue::class, 'queue.database');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Queue::before(function ($event) {
        //     dd($event);
        //     // if ($event->job->queue == 'webhooks' && $event->job->getName() == 'DeliverWebhook') {
        //     //     $cache_key = 'DeliverWebhook.'. $event->job->instance->webhook->id .'QueuedAt';
        
        //     //     if ($event->job->instance->queued_at < Cache::get($cache_key)) {
        //     //         $event->job->delete();
        
        //     //         throw new JobRequeuedException;
        //     //     }
        //     // }
        // });

        // Queue::extend('database', function () {
        //     return new QueueHandler(
        //         $this->app['db']->connection(),
        //         $this->app['config']['queue.connections.database.table'],
        //         $this->app['config']['queue.connections.database.queue'],
        //         $this->app['config']['queue.retry_after']
        //     );
        // });
        
    }
}
