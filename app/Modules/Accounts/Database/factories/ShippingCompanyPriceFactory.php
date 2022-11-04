<?php

namespace App\Modules\Accounts\Database\factories;

use App\Modules\Accounts\Entities\Helpers\helpers;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShippingCompanyPriceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Modules\Accounts\Entities\ShippingCompanyPrice::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $h = new helpers();

        return [
            'price'   => fake()->randomFloat($nbMaxDecimals = 2, $min = 10, $max = 100),
            'city_id' => $h->random_or_create(\Modules\Countries\Entities\City::class)->id,

        ];
    }
}

