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

use App\Models\Transfer;

class TransferStockEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Transfer $transfer;
    public Collection $orders;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Transfer $transfer, array $orders)
    {
        //
        $this->transfer = $transfer;
        $this->orders = collect($orders);
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
