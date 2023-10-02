<?php

namespace App\Jobs\TransferOperations;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

use App\Models\Transfer;
use App\Models\Warehouse;
use App\Models\Store;
use App\Models\ProductStock;
use App\Services\TransferService;

class WarehouseTransfer implements ShouldQueue {
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Transfer $transfer;
    protected array $order;
    protected array $serials;
    protected bool $to_store;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Transfer $transfer, array $order, array $serials, bool $to_store)
    {
        //
        $this->transfer = $transfer;
        $this->order = $order;
        $this->serials = $serials;
        $this->to_store = $to_store;
    }

    public function handle() {
        $source = Warehouse::find($this->transfer->from)->first();
        $destination = ($to_store == true) ? Store::where('id', $this->transfer->to)->first() : Warehouse::find($this->transfer->to)->first();
        $ownership = ($to_store == true) ? "STORE" : "WAREHOUSE";

        $chunks = TransferService::chunk($this->order['quantity']);
        
        foreach($chunks as $chunk) {
            $from = 'WAREHOUSE';
            dispatch(new StockTransfer($this->order['product_id'], $from, $destination->id, $ownership, $chunk, $this->transfer->from));
        }

        // $outgoing_stock = ProductStock::where('warehouse_id', $source->id)
        // ->where('product_id', $this->order['product_id'])
        // ->where('sold', false)->take($this->order['quantity'])->get();
        // $outgoing_stock->chunk(100)->each(function($batch) use ($destination, $ownership) {
        //     $this->processBatch($batch, $destination, $ownership);
        // });
        // if(count($serials) > 0) {
        //     $chunks = TransferService::chunks(count($serials));
        //     $stock = ProductStock::where('serial', $serial)->where('sold', false)->get();
        //     if(count($stock) > 0) {
        //         $stock->chunk(100)->each(function($batch) use ($destination, $ownership) {
        //             $this->processBatch($batch, $destination);
        //         });
        //     }
        // } else {
            
        // }
    }

    protected function processBatch(Collection $batch, $destination, $ownership) {

        $batch->each(function($stock) use ($ownership, $destination) {
            $stock->warehouse_id = ($ownership == 'WAREHOUSE') ? $destination->id : null;;
            $stock->ownership = $ownership;
            $stock->owner = $destination->id;
            $stock->in_transit = true;
            $stock->received = false;
            try {
                $stock->save();
            } catch (\Exception $e) {
                // Handle the exception
                Log::debug($e->getMessage());
            }
        });
    }
}

