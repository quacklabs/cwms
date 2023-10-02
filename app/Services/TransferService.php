<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Faker\Factory as Faker;
use Carbon\Carbon;

use App\Models\Warehouse;
use App\Models\Transfer;
use App\Models\TransferDetail;
use App\Models\ProductStock;
// use App\Jobs\TransferProducts;

use App\Events\ReceiveStockEvent;
use App\Events\TransferStockEvent;
use Illuminate\Support\Collection;

class TransferService {

    public static function getAllPaginated() {
        return Transfer::orderBy('created_at', 'desc')->paginate(60);
    }


    public static function getByWarehouse(int $id) {

        return Transfer::orderBy('created_at', 'desc')
        ->where('type', 'WAREHOUSE_WAREHOUSE')
        ->orWhere('type', 'WAREHOUSE_STORE')
        // ->where('owner', $id)
        ->where('from', $id)->orWhere('to', $id)->paginate(25);
    }

    public static function getByStore(int $id) {
        return Transfer::orderBy('created_at', 'desc')
        // ->where('ownership', 'STORE')
        ->where('from', $id)->orWhere('to', $id)->paginate(25);
    }

    public static function createTransfer($valid, $flag, $destination) {
        $faker = Faker::create();
        if($flag == 'git') {
            $transfer = Transfer::create([
                "tracking_no" => strtoupper($faker->bothify('???#######')),
                "to" => $valid['to'],
                "transfer_date" => Carbon::parse($valid['transfer_date']),
                "note" => $valid['notes'],
                "type" => strtoupper($flag)."_".strtoupper($destination),
            ]);
        } else {
            $transfer = Transfer::create([
                "from" => $valid['from'],
                "tracking_no" => strtoupper($faker->bothify('???#########')),
                "to" => $valid['to'],
                "transfer_date" => Carbon::parse($valid['transfer_date']),
                "note" => $valid['notes'],
                "type" => strtoupper($flag)."_".strtoupper($destination),
            ]);
        }
        TransferStockEvent::dispatch($transfer, json_decode($valid['items'], true));
        return true;
    }

    public static function receiveGoods($data, $destination) {
        $user = Auth::user();
        if($user->hasRole('manager')) {
            $ownership = "WAREHOUSE";
            $data['warehouse_id'] = $destination;
            $store = false;
        } else if($user->hasAnyRole(['storeManager'])) {
            $ownership = "STORE";
            $store = true;
        }
        $stock = ProductStock::where('product_id', $data['order_details'])
        ->where('sold', false)
        ->where('ownership', $ownership)
        ->where('in_transit', true)
        ->take($data['received'])
        ->get();
        ReceiveStockEvent::dispatch($stock, $destination, $store);
        return;
    }

    public static function chunk(int $number): Collection {
        $chunkSize = 100;
        $chunks = collect([]);
        while($number > 0) {
            $chunk = min($number, $chunkSize);
            $chunks->concat($chunk);
            $number -= $chunkSize;
        }
        return collect($chunks);
    }
    
}