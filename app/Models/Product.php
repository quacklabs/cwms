<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Unit;
use App\Models\Brand;
use Faker\Factory;

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
        'alert'
    ];

    public function categories() {
        return $this->belongsToMany(Category::class);
    }

    public function brands() {
        return $this->belongsToMany(Brand::class);
    }

    public function unit() {
        return $this->belongsToMany(Unit::class);
    }

    public static function ean13(): string {
        $faker = Factory::create();
        $ean13 = $faker->ean13;
        return $ean13;
    }

}
