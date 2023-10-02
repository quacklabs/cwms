<?php

namespace App\Listeners;

use App\Events\TransferStockEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;

use App\Enums\TransferType;
use App\Jobs\TransferOperations\WarehouseTransfer;
use App\Jobs\TransferOperations\StoreTransfer;
use App\Jobs\TransferOperations\GitTransfer;

class TransferStockListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\TransferStockEvent  $event
     * @return void
     */
    public function handle(TransferStockEvent $event) {
        // dd($event);
        $transfer = $event->transfer;
        $event->orders->each(function($order) use ($transfer) {
            $serials = json_decode($order->serials ?? "[]");
            switch(strtoupper($transfer->type)) {
                case TransferType::WAREHOUSE_WAREHOUSE:
                    dispatch(new WarehouseTransfer($transfer, $order, $serials, false));
                    break;
                case TransferType::WAREHOUSE_STORE:
                    dispatch(new WarehouseTransfer($transfer, $order, $serials, true));
                    break;
                case TransferType::STORE_STORE:
                    $job = new StoreTransfer($transfer, $order, $serials, false);
                    break;
                case TransferType::STORE_WAREHOUSE:
                    dispatch(new StoreTransfer($transfer, $order, $serials, true));
                    break;
                case TransferType::GIT_WAREHOUSE:
                    dispatch(new GitTransfer($transfer, $order, $serials, true));
                    break;
                case TransferType::GIT_STORE:
                    dispatch(new GitTransfer($transfer, $order, $serials, false));
                    break;
                default:
                    return;
            }
            return;
        });
    }
}
