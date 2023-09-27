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

use App\Models\Purchase;
use App\Models\PurchaseDetails;
use App\Events\CreateStockEvent;

class UpdatePurchase implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Purchase $purchase;
    protected array $orders;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Purchase $purchase, array $orders = []) {
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
        $details = collect($this->orders);
        $details->each(function($detail) {
            // Log::channel('custom')->debug(dump($detail));
            $order = PurchaseDetails::where('id', $detail->id)->get()->first();
            // Log::channel('custom')->debug(dump($order));
            if($order) {
                if($detail->received > $order->quantity) {
                    return;
                }
                $event = new CreateStockEvent($order, $detail->received);
                // Log::channel('custom')->debug($event);
                Event::dispatch($event);
                $order->received = $detail->received;
                $order->save();
                // Log::channel('custom')->debug('Order Updated');
            } else {
                // Log::channel('custom')->debug('No Detail found');
            }
        });
    }
}
