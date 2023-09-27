<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Services\TransactionService;
use Illuminate\Support\Collection;
// use App\Events\CreateStockEvent;
use App\Models\PurchaseDetails;
use App\Models\ProductStock;

class CreateStock implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Collection $serials;
    public PurchaseDetails $purchase;
    

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Collection $serials, PurchaseDetails $purchase) {
        //
        $this->serials = $serials;
        $this->purchase = $purchase;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $purchase = $this->purchase;
        $this->serials->each(function($serial) use ($purchase) {
            ProductStock::updateOrCreate(['serial' => $serial], [
                'purchase_id' => $purchase->purchase_id,
                'ownership' => 'GIT',
                'product_id' => $purchase->product_id,
            ]);
        });
    }
}
