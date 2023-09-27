<?php

namespace App\Listeners;

use App\Events\ReceiveStockEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Jobs\ReceiveStock;

class ReceiveStockListener
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
     * @param  \App\Events\ReceiveStockEvent  $event
     * @return void
     */
    public function handle(ReceiveStockEvent $event)
    {
        //
        $store = $event->store;
        $destination = $event->destination;
        $event->stock->chunk(200)->each(function($batch) use ($store, $destination) {
            $job = new ReceiveStock($batch, $store, $destination);
            dispatch($job);
        });
    }
}
