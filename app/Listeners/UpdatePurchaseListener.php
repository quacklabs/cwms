<?php

namespace App\Listeners;

use App\Events\UpdatePurchaseEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Purchase;
use App\Models\PurchaseDetails;
use App\Events\CreateStockEvent;

class UpdatePurchaseListener
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
     * @param  \App\Events\UpdatePurchaseEvent  $event
     * @return void
     */
    public function handle(UpdatePurchaseEvent $event)
    {
        $details = $event->details;

        foreach($details as $detail) {
            $id = $detail->id;
            $quantity = $detail->received;
            $order = PurchaseDetails::find($id);
            if($order != NULL) {
                $order->received = $quantity;
                $order->save();
                $serials = json_decode($order->serials);
                if($serials) {
                    if(count($serials) >= $quantity) {
                        $sliced = array_slice($serials, 0, $quantity);
                        $queue = [
                            'purchase_id' => $event->purchase_id,
                            'product_id' => $order->product_id,
                            'quantity' => $detail->received,
                            'serials' => $sliced
                        ];
                    }
                } else {
                    $queue = [
                        'purchase_id' => $event->purchase_id,
                        'product_id' => $order->product_id,
                        'quantity' => $detail->received,
                        'serials' => []
                    ];
                }
                event(new CreateStockEvent($queue));
            }
        }
    }
}
