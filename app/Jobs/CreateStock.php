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
// use App\Events\CreateStockEvent;

use App\Models\PurchaseDetails;
use App\Models\ProductStock;
use App\Helpers\Utils;
use App\Jobs\EnterStock;
use App\Jobs\EnterNewStockWithSerials;

class CreateStock implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    // public Collection $serials;
    public PurchaseDetails $details;
    public int $received;
    
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(PurchaseDetails $details, int $received) {
        //
        // $this->serials = $serials;
        $this->details = $details;
        $this->received = $received;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

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
                        dispatch(new EnterNewStockWithSerials($serials, $details->product_id, $details->purchase_id));
                        $serials = $serials->slice($number);
                    } else {
                        $pluckedItems = $serials->take($chunkSize);
                        $serials = $serials->slice($chunkSize);
                        dispatch(new EnterNewStockWithSerials($pluckedItems, $details->product_id, $details->purchase_id));
                    }
                    $number -= $chunkSize;
                }
            }
        } else {
            $received = $this->received;
            while ($received > 0) {
                if($chunkSize >= $received) {
                    dispatch(new EnterNewStockWithoutSerials($received, $details->product_id, $details->purchase_id));
                } else {
                    dispatch(new EnterNewStockWithoutSerials($chunkSize, $details->product_id, $details->purchase_id));
                }
                $received -= $chunkSize;
            }
        }
    }
}
