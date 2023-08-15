<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use App\Models\Unit;
use App\Models\Brand;
use Faker\Factory;
use App\Models\ProductStock;
use App\Models\SaleDetails;
use App\Traits\ActionTakenBy;
use App\Models\Action;

class Product extends Model
{
    protected $table = 'products';

    use HasFactory, ActionTakenBy;

    protected $fillable = [
        'name',
        'sku',
        'brand_id', 
        'category_id', 
        'unit_id', 
        'alert',
        'image_url',
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

    // public function getStockAttribute() {
    //     return count($this->totalInStock()->all());
    // }

    public function totalInStock(User $user=NULL) {
        if($user == null) {
            $user = Auth::user();
        }
        if($user->hasRole('admin')) {
            $warehouse = null;
        } else {
            $warehouse = ($user->warehouse() !== null) ? $user->warehouse()->id : null;
        }
        if($warehouse != null) {
            return ProductStock::where('warehouse_id', $warehouse)
            ->where('product_id', $this->id)
            ->where('sold', false)->count();
        } else {
            return ProductStock::where('product_id', $this->id)
            ->where('sold', false)->count();
        }
    }

    public function productStock(){
        return $this->hasMany(ProductStock::class, 'product_id');
    }

    public function totalSale(){
        return $this->saleDetails->sum('quantity');
    }


    public function saleDetails(){
        return $this->hasMany(SaleDetails::class);
    }

    public function actions(): MorphMany {
        return $this->morphMany(Action::class, 'model_type');
    }

    // public function unsold($warehouse_id = null) {
    //     if(isset($warehouse_id)) {
    //         return $this->hasMany(ProductStock::class, 'product_id')->where(function ($query) use ($quantityThreshold) {
    //             $query->where('quantity', '<=', $quantityThreshold);
    //         });
    //     } else {
    //         return $this->hasMany(ProductStock::class, 'product_id')->where(function ($query) use ($quantityThreshold) {
    //             $query->where('quantity', '<=', $quantityThreshold);
    //         });
    //     }
        
    // }
}
