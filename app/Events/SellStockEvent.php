<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SellStockEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public array $orders;
    public int $transaction;
    public int $warehouse_id;
    public string $order_id;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(array $orders, int $transaction, int $warehouse_id)
    {
        //
        $this->orders = $orders;
        $this->transaction = $transaction;
        $this->warehouse_id = $warehouse_id;
        // $this->order_id = $order_number;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
