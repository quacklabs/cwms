<?php
namespace App\Contracts;
use JsonSerializable;
// use Illuminate\Support\Collection;
// use App\Models\Product;

class Order implements JsonSerializable  {
    
    public int $id;
    public int $purchase_id;
    public int $quantity;
    public int $total;
    public string $serials;

    public function __construct(array $data) {
        foreach($data as $key => $value) {
            $this->$key = $value;
        };
    }

    public function jsonSerialize() {

        return [
            'purchase_id' => $this->purchase_id,
            'product_id' => $this->id,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'total' => $this->total, 
            'serials' => $this->serials ?? "[]"
        ];
        // return [
        //     "id" => $this->id,
        //     "name" => $this->name,
        //     "stock" => $this->stock,
        //     "unit" => $this->unit
        // ];
    }
}