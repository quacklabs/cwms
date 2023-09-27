<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UpdatePurchaseEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public int $purchase_id;
    public array $details;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(int $purchase_id, array $order = [])
    {
        //
        $this->purchase_id = $purchase_id;
        $this->details = $order;
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
