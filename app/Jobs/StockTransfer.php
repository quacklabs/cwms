<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use App\Models\ProductStock;

use Illuminate\Database\Eloquent\Collection;

class StockTransfer implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected int $product_id;
    protected int $destination;
    protected string $ownership;
    protected int $quantity;
    protected string $from;
    protected int $owner;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(int $product_id, string $from, int $destination, string $ownership, int $quantity, int $owner = 0)
    {
        //
        $this->product_id = $product_id;
        $this->destination = $destination;
        $this->ownership = $ownership;
        $this->quantity = $quantity;
        $this->from = $from;
        $this->owner = $owner;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $ownership = $this->ownership;
        $destination = $this->destination;
        if($this->owner != 0) {
            $outgoing_stock = ProductStock::where('owner', $this->owner)
            ->where('ownership', $this->from)
            ->where('product_id', $this->product_id)
            ->where('sold', false)->take($this->quantity)->get();
        } else {
            $outgoing_stock = ProductStock::where('warehouse_id', null)
            ->where('ownership', $this->from)
            ->where('product_id', $this->product_id)
            ->where('sold', false)->take($this->quantity)->get();
        }
        
        
        foreach($outgoing_stock as $stock) {
            $stock->warehouse_id = ($ownership == 'WAREHOUSE') ? $destination : null;
            $stock->ownership = $ownership;
            $stock->owner = $destination;
            $stock->in_transit = true;
            $stock->received = false;
            try {
                $stock->save();
            } catch (\Exception $e) {
                // Handle the exception
                Log::debug($e->getMessage());
            }
        }

        // Log::debug($this->stock);
        // $outgoing_stock->each(function($stock) use ($ownership, $destination) {
            
        // });
    }
}
