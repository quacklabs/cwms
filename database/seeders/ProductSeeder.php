<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\Unit;
use App\Models\Brand;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brand = Brand::find(1);
        $category = Category::find(1);
        $unit = Unit::find(1);

        Product::create([
            'name' => 'Pears baby oil',
            'sku' => Product::ean13(),
            'brand_id' => $brand->id,
            'unit_id' => $unit->id,
            'category_id' => $category->id
        ]);
        Product::create([
            'name' => 'Pears baby powder',
            'sku' => Product::ean13(),
            'brand_id' => $brand->id,
            'unit_id' => $unit->id,
            'category_id' => $category->id
        ]);

        $products = Product::all();

        $brand->products()->attach($products);
        $unit->products()->attach($products);
        $category->products()->attach($products);

    }
}
