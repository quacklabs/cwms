<?php

namespace App\Contracts;

class GitWarehouse {
    public string $name;
    public string $address;
    // public string 

    public function __construct() {
        $this->name = "GIT_WAREHOUSE";
        $this->address = "In Limbo";
    }
}