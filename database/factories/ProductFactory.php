<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
use Carbon\Carbon;
use Faker\Generator as Faker;


class ProductFactory extends Factory
{
    protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'name' => $this->faker->company,
            'unit_id' => mt_rand(1,3),
            'category_id' => mt_rand(1,5),
            'brand_id' => mt_rand(1,5),
            'sku' => $this->faker->ean13,
            'notes' => $this->faker->sentence,
            'alert' => mt_rand(1,5)

        ];
    }
}
