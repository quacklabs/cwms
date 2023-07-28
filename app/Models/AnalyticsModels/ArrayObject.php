<?php
namespace App\Models\AnalyticsModels;

use JsonSerializable;

class ArrayObject implements JsonSerializable {
    public string $name;
    public $value; 

    public function __construct($name, $value) {
        $this->name = $name;
        $this->value = $value;
    }

    public function jsonSerialize() {
        return [
            "name" => $this->name,
            "value" => $this->value,
        ];
    }
}