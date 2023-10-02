<?php

namespace App\Jobs\TransferOperations;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

use App\Models\Transfer;
use App\Models\Warehouse;
use App\Models\Store;
use App\Models\ProductStock;
use Illuminate\Database\Eloquent\Collection;
use App\Jobs\StockTransfer;
use App\Services\TransferService;

class GitTransfer implements ShouldQueue {
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Transfer $transfer;
    protected array $order;
    protected array $serials;
    protected bool $to_warehouse;
    protected $timeout = 1200;
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
        // $source = Store::find($this->transfer->from)->first();
        $destination = ($this->to_warehouse == false) ? Store::where('id', $this->transfer->to)->first() : Warehouse::find($this->transfer->to)->first();
        $ownership = ($this->to_warehouse == true) ? "WAREHOUSE" : "STORE";
        
        // Log::debug($this->order['quantity']);
        $chunks = TransferService::chunk($this->order['quantity']);
        // 
        // Log::debug($chunks);
        // dd($chunks);
        foreach($chunks as $chunk) {
            $from = 'GIT';
            dispatch(new StockTransfer($this->order['product_id'], $from, $destination->id, $ownership, $chunk));
        }
    }
}

