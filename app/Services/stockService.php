<?php

namespace App\Services;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Request;

use App\Models\ProductStock;
use App\Models\Product;
use App\Contracts\ProductStockResponse;
use App\Models\Adjustment;
use Faker\Factory as Faker;
use Carbon\Carbon;

class StockService {

    
    public static function searchByWarehouse(int $warehouse_id, string $keyword) {
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
        // $all_stock = Product::with('productStock')->whereHas('productStock', function ($query) {
        //     $query->where('sold', false)->groupBy('warehouse_id');
        // })->paginate(1);
        $perPage = 1;
        $page = Request::get('page', 1);
        $offset = ($page - 1) * $perPage;

        $stock = Product::orderBy('created_at', 'asc')->get();

        $all_stock = $stock->map(function ($item) {
            $productStock = ProductStock::where('product_id', $item->id)->where('sold', false)->count();
            return new ProductStockResponse($item, $productStock);
        })->values();
        $collection = new Collection($all_stock);
        $currentPageItems = $collection->slice($offset, $perPage)->all();
        $paginator = new LengthAwarePaginator($currentPageItems, count($collection), $perPage, $page);
        // Set the path for the paginator
        $paginator->setPath(Request::url());
        
        return $paginator;

        // $map = $all_stock->map(function ($items, $category) {
        //     dd($category);
        //     return new ProductStockResponse($items, $items->count());
        // });
        // dd($map);
        // return $all_stock;
    }

    public static function getStockByWarehouse($id) {
        $perPage = 25;
        $page = Request::get('page', 1);
        $offset = ($page - 1) * $perPage;

        $stock = Product::orderBy('created_at', 'asc')->get();

        $all_stock = $stock->map(function ($item) use ($id) {
            $productStock = ProductStock::where('warehouse_id', $id)
            ->where('product_id', $item->id)->where('sold', false)->count();
            return new ProductStockResponse($item, $productStock);
        })->values();
        $collection = new Collection($all_stock);
        $currentPageItems = $collection->slice($offset, $perPage)->all();
        $paginator = new LengthAwarePaginator($currentPageItems, count($collection), $perPage, $page);
        // Set the path for the paginator
        $paginator->setPath(Request::url());
        
        return $paginator;
    }

    public static function getStockByProduct(int $id, int $warehouse = NULL) {
        $perPage = 25;
        $page = Request::get('page', 1);
        $offset = ($page - 1) * $perPage;

        $stock = Product::orderBy('created_at', 'asc')->get();

        if($warehouse == NULL) {
            $all_stock = $stock->map(function ($item) use ($id, $warehouse) {
                $productStock = ProductStock::where('warehouse_id', $warehouse)
                ->where('product_id', $id)->where('sold', false)->count();
                return new ProductStockResponse($item, $productStock);
            })->values();
        } else {
            $all_stock = $stock->map(function ($item) use ($id) {
                $productStock = ProductStock::where('product_id', $id)->where('sold', false)->count();
                return new ProductStockResponse($item, $productStock);
            })->values();
        }
        
        $collection = new Collection($all_stock);
        $currentPageItems = $collection->slice($offset, $perPage)->all();
        $paginator = new LengthAwarePaginator($currentPageItems, count($collection), $perPage, $page);
        // Set the path for the paginator
        $paginator->setPath(Request::url());
        
        return $paginator;
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