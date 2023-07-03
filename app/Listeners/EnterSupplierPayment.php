<?php

namespace App\Listeners;

use App\Events\SupplierPaymentReceived;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use Faker\Factory as Faker;

use App\Models\SupplierPayment;

class EnterSupplierPayment implements ShouldQueue
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
     * @param  \App\Events\SupplierPaymentReceived  $event
     * @return void
     */
    public function handle(SupplierPaymentReceived $event)
    {
        //
        $faker = Faker::create();
        $payment = SupplierPayment::create([
            'purchase_id' => $event->purchase->id,
            'supplier_id' => $event->purchase->supplier_id,
            'amount' => $event->amount,
            'remarks' => 'Payment for purchase',
            'trx' => strtoupper($faker->bothify("?????????###"))
        ]);
    }
}
