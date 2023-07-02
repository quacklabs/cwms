<?php

namespace App\Services;
use App\Models\ProductStock;
use App\Models\Product;

class StockService
{
    
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
}