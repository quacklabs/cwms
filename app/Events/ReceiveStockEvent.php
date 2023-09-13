<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Database\Eloquent\Collection;

class ReceiveStockEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    public Collection $stock;
    public int $destination;
    public bool $store;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Collection $stock, int $destination, bool $store) {
        //
        $this->stock = $stock;
        $this->destination = $destination;
        $this->store = $store;  
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
