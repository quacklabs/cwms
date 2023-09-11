<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

use App\Models\Purchase;
// use App\Models\PurchaseDetails;

class UpdatePurchaseEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public int $purchase_id;
    public string $status;
    public array $details;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(int $purchase_id, string $status, array $order = [])
    {
        //
        $this->purchase_id = $purchase_id;
        $this->status = $status;
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
