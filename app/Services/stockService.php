<?php

namespace App\Services;

use App\Models\ProductStock;
use App\Models\Product;
use App\Contracts\ProductStockResponse;
use App\Models\Adjustment;
use Faker\Factory as Faker;
use Carbon\Carbon;

class StockService {
    
    public function searchByWarehouse(int $warehouse_id, string $keyword) {
        $all_stock = ProductStock::with('product')->where('warehouse_id', $warehouse_id)
        ->where('sold', false)
        ->whereHas('product', function ($query) use ($keyword) {
            $query->where('name', 'like', '%' . $keyword . '%')->orWhere('sku', 'LIKE', '%' . $keyword . '%');
        })->get()->groupBy('product_id');
        
        $map = $all_stock->map(function ($items, $category) {
            // dd($category);
            return [
                'product' => Product::find($category),
                'stock' => $items->count(),
            ];
        });
        return $map;
    }

    public static function getAllProductStock() {
        $all_stock = Product::with(['productStock' => function ($query) use ($id) {
            $query->select('product_id')
            ->selectRaw('SUM(1) as stock_count')
            ->groupBy('product_id');
        }])->paginate(25);
        return $all_stock;
    }

    public static function getStockByWarehouse($id) {

        $all_stock = Product::with(['productStock' => function ($query) use ($id) {
            $query->select('product_id')
            ->where('warehouse_id', $id)
            ->groupBy('product_id');
        }])->paginate(25);

        return $all_stock;
    }

    public static function getStockByProduct(int $id, int $warehouse) {
        $all_stock = Product::with(['productStock' => function ($query) use ($id, $warehouse) {
            $query->select('product_id')
            ->selectRaw('SUM(1) as stock_count')
            ->where('product_id', $id)->where('warehouse_id', $warehouse)
            ->groupBy('product_id');
        }])->paginate(1);

        return $all_stock;
    }

    public static function store_adjustment($data) {
        $faker = Faker::create();
        $adjustment = Adjustment::create([
            'warehouse_id' => $data['warehouse_id'],
            'adjust_date' => Carbon::parse($data['adjust_date']),
            'tracking_no' => $faker->bothify("???########"),
        ]);

        if($data['notes']) {
            $adjustment->note = $data['notes'];
        }

        $orders = array_map(function($order) {
            return [
                'product_id' => $order->product_id,
                'quantity' => $order->quantity,
                'adjust_type' => $order->adjust_type
            ];
        }, json_decode($data['items']));
        $adjustment->details()->createMany($orders);

        foreach($orders as $order) {
            
            switch($order['adjust_type']) {
                case 1:
                    $remove = ProductStock::where('warehouse_id', $adjustment->warehouse_id)
                    ->where('product_id', $order['product_id'])
                    ->where('sold', false)->take($order['quantity'])->pluck('id')->flatten()->all();
                    ProductStock::destroy($remove);
                    break;
                case 2:
                    $range = range(1, $order['quantity']);
                    foreach($range as $item) {
                        ProductStock::create([
                            'warehouse_id' => $adjustment->warehouse_id,
                            'product_id' => $order['product_id'],
                            'serial' => $faker->ean13
                        ]);
                    }
                    break;
            }
        }
        return $adjustment;
    }
}