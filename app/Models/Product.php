<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Unit;
use App\Models\Brand;
use Faker\Factory;
use App\Models\ProductStock;
use App\Models\SaleDetails;

class Product extends Model
{
    protected $table = 'products';

    use HasFactory;
    protected $fillable = [
        'name',
        'sku',
        'brand_id', 
        'category_id', 
        'unit_id', 
        'alert',
        'image',
        'notes'
    ];
    
    public function categories() {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function brands() {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function unit() {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public static function ean13(): string {
        $faker = Factory::create();
        $ean13 = $faker->ean13;
        return $ean13;
    }

    public function totalInStock() {
        return $this->productStock->sum('quantity');
    }

    public function productStock(){
        return $this->hasMany(ProductStock::class);
    }

    public function totalSale(){
        return $this->saleDetails->sum('quantity');
    }


    public function saleDetails(){
        return $this->hasMany(SaleDetails::class);
    }

}
