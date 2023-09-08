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
        //
        $purchase = Purchase::find($event->purchase_id);
        if($purchase != null) {
            $purchase->status = $event->status;
            $purchase->save();

            if(strtolower($event->status) == 'received' && count($event->order_details) > 0) {
                $total = count($event->order_details) - 1;
                for ($i = 0; $i < $total; $i++) {
                    $id = $event->order_details[$i]->id;
                    $quantity = $event->order_details[$i]->received;
                    $order = PurchaseDetails::find($id);
                    if($order != NULL) {
                        $order->received = $quantity;
                        $order->save();
                        $serials = json_decode($order->serials);
                        if(count($serials) >= $quantity) {
                            $sliced = array_slice($serial, 0, $quantity);
                            $queue = [
                                'product_id' => $order->id,
                                'quantity' => $order->quantity,
                                'serials' => $sliced
                            ];
                        } else {
                            $queue = [
                                'product_id' => $order->id,
                                'quantity' => $order->quantity,
                                'serials' => []
                            ];
                        }
                        event(new CreateStockEvent($queue));
                    }
                }
            }
        }
    }
}
