<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CreateStockEvent
{
    use Dispatchable;
    public int $purchase_id;
    public int $product_id;
    public int $quantity;
    public array $serials;
    // public $amount;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(array $orders)
    {
        //
        $this->purchase_id = $orders['purchase_id'];
        $this->product_id = $orders['product_id'];
        $this->quantity = $orders['quantity'];
        $this->serials = $orders['serials'];
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
