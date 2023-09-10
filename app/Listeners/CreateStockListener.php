<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\CreateStockEvent;
use App\Services\TransactionService;
use Faker\Factory as Faker;

class CreateStockListener
{
    use ShouldQueue, InteractsWithQueue;
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
        //
        foreach($event->orders as $order) {
            $serials = $order['serials'];

            if(count($serials) > 0) {
                foreach($serials as $serial) {
                    ProductStock::updateOrCreate([
                        // 'warehouse_id' => $data['warehouse_id'],
                        // 'owner' => $['warehouse_id'],
                        'ownership' => 'GIT',
                        'product_id' => $order['product_id'],
                        'serial' => $serial,
                    ]);
                }
            } else {
                foreach (range(1, $order['quantity']) as $index) {
                    ProductStock::create([
                        // 'warehouse_id' => $data['warehouse_id'],
                        'product_id' => $order['product_id'],
                        // 'owner' => $data['warehouse_id'],
                        'ownership' => 'GIT',
                        'serial' => TransactionService::newInvoice(),
                    ]);
                }
            }
        }
    }
}
