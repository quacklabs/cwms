<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\CreatePurchaseEvent;
use App\Models\Purchase;
use App\Jobs\EnterPurchaseDetails;

class CreatePurchaseListener
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
     * @param CreatePurchaseEvent $event
     * @return void
     */
    public function handle(CreatePurchaseEvent $event)
    {
        // dd($event);
        $id = $event->transaction_id;
        $purchase = Purchase::where('id', $event->transaction_id)->first();
        if($purchase) {
            $event->orders->chunk(10)->each(function($batch) use ($id) {
                EnterPurchaseDetails::dispatch($batch, $id);
            });
            return;
        }
        return;
    }
}
