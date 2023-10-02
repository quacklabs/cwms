<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Contracts\Order;
use App\Models\PurchaseDetails;
use Illuminate\Support\Collection;

class EnterPurchaseDetails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public int $purchase;
    public Collection $orders;
    /**
     * Create a new job instance.
     * 
     * @ a Collection of Order Objects
     * @return void
     */
    public function __construct(Collection $orders, int $purchase)
    {
        //
        $this->orders = $orders;
        $this->purchase = $purchase;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle() {
        foreach($this->orders as $order) {
            $order->purchase_id = $this->purchase;
            PurchaseDetails::create($order->jsonSerialize());
        }
    }
}
