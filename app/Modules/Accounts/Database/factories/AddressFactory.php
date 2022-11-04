<?php

namespace App\Modules\Accounts\Database\factories;

use App\Modules\Accounts\Entities\Helpers\helpers;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Modules\Accounts\Entities\Address::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $h = new helpers();

        return [
            'address' => fake()->address,
            'is_primary' => 1,
            'user_id' => $h->random_or_create(\App\Modules\Accounts\Entities\Customer::class)->id,
            'city_id' => $h->random_or_create(\App\Modules\Countries\Entities\City::class)->id,
        ];
    }
}

