<?php

namespace App\Contracts;
use App\Models\Product;

class ProductStockResponse {
    public $product;
    public $stock;

    public function __construct(Product $product, int $stock) {
        $this->product = $product;
        $this->stock = $stock;
    }
}