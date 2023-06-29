<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;


use App\Models\Transfer;

class TransferProducts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $transfer;
    protected $orders;
    // protected User $scheduled_by;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Transfer $transfer, array $orders)
    {
        //
        $this->transfer = $transfer;
        $this->orders = $orders;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //

        $orders = array_map(function($order) {
            return [
                'product_id' => $order->product_id,
                'quantity' => $order->quantity,
            ];
        }, $this->orders);

        $this->transfer->details()->createMany($this->orders);

        $source = $transfer->source_warehouse;
        $destination = $transfer->destination_warehouse;

        $transfer->details->each(function($detail) use ($source, $destination) {
            $quantity = $detail->quantity;
            $outgoing_stock = ProductStock::updateOrCreate(
                ['warehouse_id' => $source->id, 'product_id' => $detail->product_id],
                ['quantity' => DB::raw("status - $quantity")]);
            
            $incoming_stock = ProductStock::updateOrCreate(
                ['warehouse_id' => $destination->id, 'product_id' => $detail->product_id], 
                ['quantity' => DB::raw("status + $quantity")]);
        });

        foreach($this->orders as $order) {

            $serials = $order->serials;

            if($serials) {
                $serials = json_encode($serials);
                if(count($serial > 0)) {
                    // $item = 
                }

            }
            // if(count(json_encode($order->serials)))
        }

        if($this->orders->serials && count()) {
            foreach ($this->orders->serials as $order) {
                $processedItem = [
                    'title' => $item->title,
                    'description' => $item->description,
                ];
        
                // Other processing specific to each item
        
                $processedItems[] = $processedItem;
            }
        }

       
        
    }
}
