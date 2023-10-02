<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class EnterStock implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    protected string $serial;
    protected int $product;
    protected int $putchase;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $serial = '', int $product, int $purchase)
    {
        //
        $this->serial = $serial;
        $this->product = $product;
        $this->purchase = $purchase;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        Log::debug("will add new stock");
    }
}
