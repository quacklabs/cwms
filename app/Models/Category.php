<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Traits\ActionTakenBy;

class Category extends Model
{
    use HasFactory;
    protected $table = "categories";

    protected $fillable = [ "name","status"];

    public function getProductCountAttribute() {
        return count($this->products);
    }

    public function products() {
        return $this->belongsToMany(Product::class);
    }
}
