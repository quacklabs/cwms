<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\CreateStockEvent;
use App\Services\TransactionService;
use Faker\Factory as Faker;
use App\Models\ProductStock;

class CreateStockListener
{
    // use InteractsWithQueue;
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
    public function handle(CreateStockEvent $event)
    {
        $serials = $event->serials;
        if(count($serials) > 0) {
            foreach($serials as $serial) {
                ProductStock::updateOrCreate([
                    // 'warehouse_id' => $data['warehouse_id'],
                    // 'owner' => $['warehouse_id'],
                    'ownership' => 'GIT',
                    'product_id' => $event->product_id,
                    'serial' => $serial,
                ]);
            }
        } else {
            if($event->quantity == 0) {
                return;
            }
            foreach (range(1, $event->quantity) as $index) {
                ProductStock::create([
                    'purchase_id' => $event->purchase_id,
                    // 'warehouse_id' => $data['warehouse_id'],
                    'product_id' => $event->product_id,
                    // 'owner' => $data['warehouse_id'],
                    'ownership' => 'GIT',
                    'serial' => TransactionService::newInvoice(),
                ]);
            }
        }
    }
}
