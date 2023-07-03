<?php

namespace App\Listeners;

use App\Events\CustomerPaymentReceived;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Faker\Factory as Faker;
use App\Models\CustomerPayment;

class EnterCustomerPayment
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
     * @param  \App\Events\CustomerPaymentReceived  $event
     * @return void
     */
    public function handle(CustomerPaymentReceived $event)
    {
        //
        $faker = Faker::create();
        $payment = CustomerPayment::create([
            'sale_id' => $event->sale->id,
            'customer_id' => $event->sale->customer_id,
            'amount' => $event->amount,
            'remarks' => 'Payment for sale',
            'trx' => strtoupper($faker->bothify("?????????###"))
        ]);
    }
}
