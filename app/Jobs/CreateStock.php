<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Services\TransactionService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

use App\Models\PurchaseDetails;
use App\Models\ProductStock;

use App\Helpers\UserJob;
use App\Helpers\Utils;
use App\Jobs\EnterStock;
use App\Jobs\EnterNewStockWithSerials;
use App\Contracts\StockOrder;
use App\Models\AppModels\Task;


// use Junges\TrackableJobs\Traits\Trackable;
// use Junges\TrackableJobs\Models\TrackedJob;
// use 
// use Junges\TrackableJobs\Concerns\Trackable;
use App\Traits\Trackable;

class CreateStock implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Trackable;

    // public Collection $serials;
    public PurchaseDetails $details;
    public int $received;
    protected $name;
    
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(int $user_id, PurchaseDetails $details, int $received) {
        
        $this->user_id = $user_id;
        $this->details = $details;
        $this->received = $received;
        $this->name = 'create_stock';
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // $this->trackedJob = Task::where('trackable_id', $this->job->getJobId())
        // ->where('user_id', $this->user_id)->first();
        $this->model = $this->job->getJobId();

        $details = $this->details;
        $serials = json_decode($details->serials);
        $chunkSize = Utils::calculateSmartChunk($this->received);
        Log::info("Chunk Size: {$chunkSize} - total: {$this->received} ");

        if($serials != null) {
            if(count($serials) > 0) {
                $serials = collect($serials);
                $number = count($serials);

                while ($number > 0) {
                    if($chunkSize >= $number) {
                        dispatch(new EnterNewStockWithSerials($this->user_id, $serials, $details->product_id, $details->purchase_id));
                        $serials = $serials->slice($number);
                    } else {
                        $pluckedItems = $serials->take($chunkSize);
                        $serials = $serials->slice($chunkSize);
                        dispatch(new EnterNewStockWithSerials($this->user_id, $pluckedItems, $details->product_id, $details->purchase_id));
                    }
                    $number -= $chunkSize;
                }
            }
        } else {
            $received = $this->received;
            while ($received > 0) {
                if($chunkSize >= $received) {
                    dispatch(new EnterNewStockWithoutSerials($this->user_id, $received, $details->product_id, $details->purchase_id));
                } else {
                    dispatch(new EnterNewStockWithoutSerials($this->user_id, $chunkSize, $details->product_id, $details->purchase_id));
                }
                $received -= $chunkSize;
            }
        }
    }
}
