<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Faker\Factory as Faker;
use Carbon\Carbon;

use App\Models\Warehouse;
use App\Models\Transfer;
use App\Models\TransferDetail;
use App\Models\ProductStock;
use App\Jobs\TransferProducts;

use App\Events\ReceiveStockEvent;

class TransferService {

    public static function getAllPaginated() {
        return Transfer::orderBy('created_at', 'desc')->paginate(60);
    }


    public static function getByWarehouse(int $id) {

        return Transfer::orderBy('created_at', 'desc')
        // ->where('ownership', 'WAREHOUSE')
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
        $transfer = Transfer::create([
            "tracking_no" => strtoupper($faker->bothify('???########')),
            "to" => $valid['to'],
            "transfer_date" => Carbon::parse($valid['transfer_date']),
            "note" => $valid['notes'],
            "type" => strtoupper($flag)."_".strtoupper($destination),
        ]);
        
        $job = new TransferProducts($transfer, json_decode($valid['items'], true));
        dispatch($job);
        return;
    }

    public static function receiveGoods($data, $destination) {
        $user = Auth::user();
        if($user->hasRole('manager')) {
            $ownership = "WAREHOUSE";
            $data['warehouse_id'] = $destination;
            $store = false;
        } else if($user->hasAnyRole(['storeManager', 'manager'])) {
            $ownership = "STORE";
            $store = true;
        }
        $stock = ProductStock::where('product_id', $data['order_details'])
        ->where('sold', false)
        ->where('ownership', $ownership)
        ->where('in_transit', true)
        ->take($data['received'])
        ->get();
        event(new ReceiveStockEvent($stock, $destination, $store));
    }
    
}