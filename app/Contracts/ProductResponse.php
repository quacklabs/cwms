<?php
namespace App\Contracts;
use JsonSerializable;
use App\Models\Product;

class ProductResponse implements JsonSerializable {
    public $id;
    public $name;
    public $stock;
    public $unit;

    public function __construct(int $id, string $name, int $stock) {
        $this->id = $id;
        $this->name = $name;
        $this->stock = $stock;
        $this->unit = Product::find($id)->first()->unit->name;
    }

    public function jsonSerialize() {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "stock" => $this->stock,
            "unit" => $this->unit
        ];
    }
}