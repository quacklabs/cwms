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
use App\Jobs\StockTransfer;

class StoreTransfer implements ShouldQueue {
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Transfer $transfer;
    protected array $order;
    protected array $serials;
    protected bool $to_warehouse;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Transfer $transfer, array $order, array $serials, bool $to_warehouse)
    {
        //
        $this->transfer = $transfer;
        $this->order = $order;
        $this->serials = $serials;
        $this->to_warehouse = $to_warehouse;
    }

    public function handle() {
        $source = Store::find($this->transfer->from)->first();
        $destination = ($this->to_warehouse == false) ? Store::where('id', $this->transfer->to)->first() : Warehouse::find($this->transfer->to)->first();
        $ownership = ($this->to_warehouse == true) ? "WAREHOUSE" : "STORE";

        $chunks = TransferService::chunk($this->order['quantity']);
        
        foreach($chunks as $chunk) {
            $from = 'STORE';
            dispatch(new StockTransfer($this->order['product_id'], $from, $destination->id, $ownership, $chunk, $this->transfer->from));
        }
    }
}

