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

class SupplierPaymentReceived
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $purchase;
    public $amount;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Purchase $purchase, float $amount)
    {
        //
        $this->purchase = $purchase;
        $this->amount = $amount;
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
