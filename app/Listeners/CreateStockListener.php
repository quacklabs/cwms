<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Collection;
use App\Events\CreateStockEvent;
use App\Services\TransactionService;

use Faker\Factory as Faker;
use App\Models\ProductStock;
use App\Jobs\CreateStock;

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
    public function handle(CreateStockEvent $event) {
        $serials = collect([]);
        $purchase_serials = json_decode($event->purchase->serials);
        if($purchase_serials != NULL) {
            if(count($purchase_serials) > 0) {
                if($event->quantity > count($serials)) {
                    $serials->concat($purchase_serials);
                    $additionalValues = $event->quantity - count($purchase_serials);

                    for ($i = 0; $i < $additionalValues; $i++) {
                        $randomString = TransactionService::newInvoice();
                        $serials->push($randomString);
                    }
                }
            } else {
                $serials = $this->generateSerials($event->quantity);
            }
        } else {
            $serials = $this->generateSerials($event->quantity);
        }

        $purchase = $event->purchase;
        $serials->chunk(100)->each(function($batch) use ($purchase) {
            $job = new CreateStock($batch, $purchase);
            dispatch($job);
        });
    }

    protected function generateSerials(int $quantity): Collection {
        $serials = collect([]); //$randomString;
        $range = range(1, $quantity);
        collect($range)->chunk(100)->each(function($batch) use($serials) {
            foreach($batch as $number) {
                $randomString = TransactionService::newInvoice();
                $serials->push($randomString);
            }
        });
        return $serials;
    }
}
