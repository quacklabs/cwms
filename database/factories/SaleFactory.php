<?php

namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use App\Models\Sale;
use Carbon\Carbon;

class SaleFactory extends Factory
{
    protected $model = Sale::class;
    
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'customer_id' => mt_rand(1,2),
            'invoice_no' => $this->faker->ean13,
            'warehouse_id' => mt_rand(1,2),
            'sale_date' => Carbon::parse($this->faker->dateTimeThisYear()),
            'total_price' => $this->faker->randomNumber(4),
            'discount_amount' => 4.00,
            'received_amount' => $this->faker->randomNumber(3),
            'return_status' => false,
        ];
    }
}
