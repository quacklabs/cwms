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
        if($purchase_serials != NULL && count($purchase_serials) > 0) {
            $serials->concat($purchase_serials);
        }

        if($event->quantity > count($serials)) {
            
        }
        dispatch(new CreateStock($serials, $event->purchase));
        // schdule jobs for items with serial numbers
        $data = collect([
            "product_id" => $event->purchase->product_id,
            "serials" => count()
        ]);;
        

        $additionalValues = $event->quantity - count($purchase_serials);

        for ($i = 0; $i < $additionalValues; $i++) {
            $randomString = TransactionService::newInvoice();
            $serials->push($randomString);
        }

        // $purchase = ;
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
