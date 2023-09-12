<?php

namespace App\Contracts;
use App\Models\Product;

class ProductStockResponse {
    public Product $product;
    public int $stock;

    public function __construct(Product $product, int $stock) {
        $this->product = $product;
        $this->stock = $stock;
    }
}