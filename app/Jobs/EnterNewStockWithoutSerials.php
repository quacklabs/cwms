<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Services\TransactionService;
use App\Models\ProductStock;
use App\Traits\Trackable;

class EnterNewStockWithoutSerials implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Trackable;
    protected int $quantity;
    protected int $product_id;
    protected int $purchase_id;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(int $user_id, int $quantity, int $product_id, int $purchase_id)
    {
        //
        $this->user_id = $user_id;
        $this->quantity = $quantity;
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
        //
        // $this->trackedJob = Task::where('trackable_id', $this->job->getJobId())
        // ->where('user_id', $this->user_id)->first();

        $quantity = $this->quantity;
        while($quantity > 0) {
            ProductStock::create([
                'serial' => TransactionService::newInvoice(),
                'ownership' => 'GIT',
                'product_id' => $this->product_id,
                'purchase_id' => $this->purchase_id
            ]);
            $quantity -= 1;
        }
    }
}
