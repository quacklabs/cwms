<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Illuminate\Support\Collection;

class EnterNewStockWithSerials implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected Collection $serials;
    protected int $product_id;
    protected int $purchase_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Collection $serials, $product_id, $purchase_id)
    {
        //
        $this->serials = $serials;
        $this->product_id = $product_id;
        $this->purchase_id = $purchase_id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach($this->serials as $serial) {
            ProductStock::updateOrCreate(['serial' => $serial],[
                'ownership' => 'GIT',
                'purchase_id' => $this->purchase_id,
                'product_id' => $this->product_id
            ]);
            return;
        }
    }
}
