<?php

namespace App\Services;

use Faker\Factory as Faker;
use Carbon\Carbon;

use App\Models\Warehouse;
use App\Models\Transfer;
use App\Models\TransferDetail;
use App\Models\ProductStock;
use App\Jobs\TransferProducts;

class TransferService {

    public static function getAllPaginated() {
        return Transfer::orderBy('created_at', 'desc')->paginate(60);
    }


    public static function getByWarehouse(int $id) {

        return Transfer::orderBy('created_at', 'desc')->where('from_warehouse', $id)->orWhere('to_warehouse', $id)->paginate(25);
    }

    public static function createTransfer($valid) {
        $faker = Faker::create();
        $transfer = Transfer::create([
            'tracking_no' => strtoupper($faker->bothify('???########')),
            'from_warehouse' => $valid['from_warehouse'],
            'to_warehouse' => $valid['to_warehouse'],
            'transfer_date' => Carbon::parse($valid['transfer_date']),
            'note' =>$valid['notes']
        ]);
        $job = new TransferProducts($transfer, json_decode($valid['items']));
        dispatch($job);
        return;
    }
    
}