<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Collection;
use Illuminate\Contracts\Queue\Job;

// use Junges\TrackableJobs\Concerns\Trackable;
use App\Traits\Trackable;

use App\Models\Purchase;
use App\Models\PurchaseDetails;
use App\Helpers\Utils;
use App\Models\AppModels\Task;
// use App\Helpers\UserJob;

// use App\Helpers\StockOrder;

class UpdatePurchase implements ShouldQueue {
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Trackable;

    // public int $user_id;
    public Purchase $purchase;
    public Collection $orders;
    public string $name = "UpdatePurchase";
    // public $model;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(int $user_id, Purchase $purchase, Collection $orders) {
        $this->purchase = $purchase;
        $this->orders = $orders;
        $this->user_id = $user_id;
        // dump($this->job->getJobId());
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        
       $this->model = $this->job->getJobId();
        
        $purchase = $this->purchase;
        // $chunks = Utils::smartChunk()
        $this->orders->each(function($detail) use ($purchase) {
            $order = PurchaseDetails::where('id', $detail->id)->first();
            if($order) {
                $total = intval($order->received) + intval($detail->received);
                if(intval($total) <= intval($order->quantity)) {
                    dispatch(new CreateStock($this->trackedJob->user_id, $order, $detail->received));
                    $order->received = $total;
                    $order->save();
                    return;
                }
            } else {
                Log::debug("Failed to parse detail");
            }
        });
    }
}
