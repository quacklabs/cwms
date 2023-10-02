<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class CreatePurchaseEvent {
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public int $transaction_id;
    public Collection $orders;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(int $transaction_id, Collection $orders)
    {
        //
        $this->transaction_id = $transaction_id;
        $this->orders = $orders;
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
