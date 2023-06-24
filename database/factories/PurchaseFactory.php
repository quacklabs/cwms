<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

class PurchaseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'supplier_id' => mt_rand(1,2),
            'invoice_no' => $this->faker->ean13,
            'warehouse_id' => mt_rand(1,2),
            'purchase_date' => Carbon::parse($this->faker->dateTimeThisYear()),
            'total_price' => $this->faker->randomNumber(4,2),
            'discount_amount' => 4.00,
            'received_amount' => $this->faker->randomNumber(3,2),
            'return_status' => false,
        ];
    }
}
