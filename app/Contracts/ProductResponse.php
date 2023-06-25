<?php
namespace App\Contracts;

class ProductResponse {
    public $id;
    public $name;
    public $stock;

    public function __construct(int $id, string $name, int $stock) {
        $this->id = $id;
        $this->name = $name;
        $this->stock = $stock;
    }
}