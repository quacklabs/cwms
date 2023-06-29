<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Unit;

class ProductService
{

    public static function create($info, $file = null) {
        if($info['sku'] == '' || $info['sku'] == NULL) {
            $info['sku'] = Product::ean13();
        }
        $product = Product::create($info);
        if($file != null) {
            // Generate a unique name for the file
            $fileName = $info['sku'].'.'. $file->getClientOriginalExtension();

            // Get the storage disk
            $path = $file->storeAs('public', $fileName);

            // Retrieve the public URL for the stored file
            $url = $url = URL::to('/') . Storage::url($path);
            $product->image_url = $url;
            $product->save();
        }
        return $product;
    }

    public static function getAllProducts() {
        return Product::orderBy('created_at', 'desc')->paginate(25);
    }

    public static function getByWarehouse($id) {

    }

    public static function categories() {
        return Category::all();
    }

    public static function brands() {
        return Brand::all();
    }

    public static function units() {
        return Unit::all();
    }
}