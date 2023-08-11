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
use App\Models\ProductStock;
use App\Enums\TransferType;
use App\Models\Warehouse;
use App\Models\Store;

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
        $orders = array_map(function($order) {
            return [
                'product_id' => $order->product_id,
                'quantity' => $order->quantity,
                // 'serials' => $order->serials ?? "[]"
            ];
        }, $this->orders);

        $this->transfer->details()->createMany($orders);

        foreach($this->orders as $order) {

            $serials = json_decode($order->serials ?? "[]");
            switch(strtoupper($this->transfer->type)) {
                case TransferType::WAREHOUSE_WAREHOUSE:
                    $this->warehouse2warehouse($order, $serials);
                    break;
                case TransferType::WAREHOUSE_STORE:
                    $this->warehouse2store($order, $serials);
                    break;
                case TransferType::STORE_WAREHOUSE:
                    $this->store2warehouse($order, $serials);
                    break;
                case TransferType::STORE_STORE:
                    $this->store2store($order, $serials);
                    break;
            }
            
        }
    }

    private function warehouse2warehouse($order, $serials) {
        $source = Warehouse::find($this->transfer->from)->first();
        $destination = Warehouse::find($this->transfer->to)->first();

        if(count($serials) > 0) {
            $outgoing_stock = array_map(function($serial) use ($order) {
                return ProductStock::where('serial', $serial)->where('sold', false);
            }, $serials);
        } else {
            $outgoing_stock = ProductStock::where('warehouse_id', $source->id)
            ->where('product_id', $order->product_id)
            ->where('sold', false)->take($order->quantity)->get();
        }
        $outgoing_stock->each(function($stock) use ($destination) {
            $stock->warehouse_id = $destination->id;
            $stock->ownership = "WAREHOUSE";
            $stock->owner = $destination->id;
            $stock->save();
        });
    }

    private function warehouse2store($order, $serials) {
        $source = Warehouse::find($this->transfer->from)->first();
        $destination = Store::find($this->transfer->to)->first();

        if(count($serials) > 0) {
            $outgoing_stock = array_map(function($serial) use ($order) {
                return ProductStock::where('serial', $serial)->where('sold', false);
            }, $serials);
        } else {
            $outgoing_stock = ProductStock::where('warehouse_id', $source->id)
            ->where('product_id', $order->product_id)
            ->where('sold', false)->take($order->quantity)->get();
        }
        
        $outgoing_stock->each(function($stock) use ($destination) {
            // $stock->warehouse_id = $destination->id;
            $stock->ownership = "STORE";
            $stock->owner = $destination->id;
            $stock->save();
        });
    }

    private function store2warehouse($order, $serials) {
        $source = Store::find($this->transfer->from)->first();
        $destination = Warehouse::find($this->transfer->to)->first();

        if(count($serials) > 0) {
            $outgoing_stock = array_map(function($serial) use ($order) {
                return ProductStock::where('serial', $serial)->where('sold', false);
            }, $serials);
        } else {
            $outgoing_stock = ProductStock::where('owner', $source->id)
            ->where('ownership', 'STORE')
            ->where('product_id', $order->product_id)
            ->where('sold', false)->take($order->quantity)->get();
        }
        $outgoing_stock->each(function($stock) use ($destination) {
            $stock->warehouse_id = $destination->id;
            $stock->ownership = "WAREHOUSE";
            $stock->owner = $destination->id;
            $stock->save();
        });
    }

    private function store2store($order, $serials) {
        $source = Store::find($this->transfer->from)->first();
        $destination = Store::find($this->transfer->to)->first();

        if(count($serials) > 0) {
            $outgoing_stock = array_map(function($serial) use ($order) {
                return ProductStock::where('serial', $serial)->where('sold', false);
            }, $serials);
        } else {
            $outgoing_stock = ProductStock::where('owner', $source->id)
            ->where('ownership', 'STORE')
            ->where('product_id', $order->product_id)
            ->where('sold', false)->take($order->quantity)->get();
        }
        $outgoing_stock->each(function($stock) use ($destination) {
            // $stock->warehouse_id = $destination->id;
            $stock->ownership = "STORE";
            $stock->owner = $destination->id;
            $stock->save();
        });
    }
}
