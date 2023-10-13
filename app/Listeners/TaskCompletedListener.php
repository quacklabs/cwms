<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\TaskCompletedEvent;
use Pusher\PushNotifications\PushNotifications;

class TaskCompletedListener
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
    public function handle(TaskCompletedEvent $event)
    {
        $pusher = new PushNotifications(
            array(
              "instanceId" => env('BEAM_INSTANCE_ID'),
              "secretKey" => env('BEAM_SECRET_KEY'),
            )
        );

        $pusher->publishToUsers(
            array("".$event->user->id.""),
            array(
                "web" => array(
                    "data" => array(
                        "title" => $event->action
                    )
                )
            )
        );
        return;
    }
}
