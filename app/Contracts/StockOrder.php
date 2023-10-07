<?php

namespace App\Contracts;

use JSONSerializable;

class StockOrder {
    public $purchase;
    public $orders;

    public function __construct($purchase, $orders) {
        $this->purchase = $purchase;
        $this->orders = $orders;
    }
}

class ProductOrder {
    public int $detail_id;
    public int $product_id;
    public int $quantity;

    public function __construct(int $detail_id, int $product_id, int $quantity) {
        $this->$detail_id = $detail_id;
        $this->product_id = $product_id;
        $this->quantity = $quantity;
    }
}