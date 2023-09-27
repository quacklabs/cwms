<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\ProductStock;
use Illuminate\Database\Eloquent\Collection;

class ReceiveStock implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Collection $batch;
    public bool $store;
    public int $destination;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Collection $batch, bool $store, int $destination) {
        //
        $this->batch = $batch;
        $this->store = $store;
        $this->destination = $destination;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        $destination = $this->destination;
        $store = $this->store;
        $this->batch->each(function($stock) use ($store, $destination) {
            if(!$store) {
                $stock->warehouse_id = $destination;
            }
            $stock->in_transit = false;
            $stock->save();
            return;
        });
        
        
    }
}
