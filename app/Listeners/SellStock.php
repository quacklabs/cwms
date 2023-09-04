<?php

namespace App\Listeners;

use App\Events\SellStockEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SellStock {
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
     * @param  \App\Events\SellStockEvent  $event
     * @return void
     */
    public function handle(SellStockEvent $event)
    {
        //
        foreach($event->orders as $order) {
            $serials = json_decode($order['serials']);

            if(count($serials) > 0) {
                foreach($serials as $serial) {
                    ProductStock::updateOrCreate(['product_id' => $order['product_id'], 'warehouse_id' => $event->warehouse_id, 'serial', $serial], [
                        'sold' => true,
                        'sale_id' => $event->transaction,
                        'sold_by' => auth()->user()->id,
                        'sold_from' => $event->warehouse_id
                    ]);
                }
            } else {
                $stock = ProductStock::where('warehouse_id', $event->warehouse_id)
                ->where('product_id', $order['product_id'])
                ->where('sold', false)->take($order['quantity'])->get();
                foreach($stock as $item) {
                    $item->sold = true;
                    $item->sale_id = $event->transaction;
                    $item->sold_by = auth()->user()->id;
                    $item->sold_from = $event->warehouse_id;
                    $item->save();
                }
            }
        }
    }
}
