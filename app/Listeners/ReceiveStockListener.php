<?php

namespace App\Listeners;

use App\Events\ReceiveStockEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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
        $event->stock->each(function($stock) use ($store, $destination) {
            if(!$store) {
                $stock->warehouse_id = $destination;
            }
            $stock->in_transit = false;
            $stock->save();
            return;
        });
    }
}
