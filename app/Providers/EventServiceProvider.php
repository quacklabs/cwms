<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

use App\Events\SupplierPaymentReceived;
use App\Events\CustomerPaymentReceived;
use App\Events\UpdatePurchaseEvent;
use App\Events\CreateStockEvent;
use App\Events\ReceiveStockEvent;

use App\Listeners\EnterCustomerPayment;
use App\Listeners\EnterSupplierPayment;
use App\Listeners\UpdatePurchaseListener;
use App\Listeners\CreateStockListener;
use App\Listeners\ReceiveStockListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        SupplierPaymentReceived::class => [
            EnterSupplierPayment::class
        ],
        CustomerPaymentReceived::class => [
            EnterCustomerPayment::class
        ],
       
        CreateStockEvent::class => [
            CreateStockListener::class
        ],
        ReceiveStockEvent::class => [
            ReceiveStockListener::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
