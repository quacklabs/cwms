<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Collection;

use App\Models\Purchase;
use App\Models\PurchaseDetails;
use App\Helpers\Utils;
// use App\Events\CreateStockEvent;

class UpdatePurchase implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Purchase $purchase;
    protected Collection $orders;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Purchase $purchase, Collection $orders) {
        $this->purchase = $purchase;
        $this->orders = $orders;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // $chunks = $this->orders->smartChunk();
        // Log::debug($chunks);
        $purchase = $this->purchase;
        // $chunks = Utils::smartChunk()
        $this->orders->each(function($detail) use ($purchase) {
            $order = PurchaseDetails::where('id', $detail->id)->first();
            if($order) {
                $total = intval($order->received) + intval($detail->received);
                if(intval($total) <= intval($order->quantity)) {
                    dispatch(new CreateStock($order, $detail->received));
                    $order->received = $total;
                    $order->save();
                    return;
                }
            } else {
                Log::debug("Failed to parse detail");
            }
        });
    }
}
