<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Traits\ActionTakenBy;

class Brand extends Model
{
    use HasFactory, ActionTakenBy;
    protected $table = "brands";

    protected $fillable = ["name", "status"];

    public function getProductCountAttribute() {
        return count($this->products);
    }

    public function products() {
        return $this->belongsToMany(Product::class);
    }
}
