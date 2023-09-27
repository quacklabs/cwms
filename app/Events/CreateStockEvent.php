<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\PurchaseDetails;

class CreateStockEvent
{
    use Dispatchable;
    public PurchaseDetails $purchase;
    public int $quantity;
    // public $amount;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(PurchaseDetails $purchase, int $quantity)
    {
        //
        $this->purchase = $purchase;
        $this->quantity = $quantity;
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
