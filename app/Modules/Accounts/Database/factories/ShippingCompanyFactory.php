<?php

namespace App\Modules\Accounts\Database\factories;

use App\Modules\Accounts\Entities\Helpers\helpers;
use App\Modules\Accounts\Entities\ShippingCompany;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShippingCompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Modules\Accounts\Entities\ShippingCompany::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $h = new helpers();
        return [
            'owner_id' => $h->random_or_create(\App\Modules\Accounts\Entities\ShippingCompanyOwner::class)->id,
            'name:ar' => 'hello ar '.fake()->company,
            'name:en' => 'hello en ' .fake()->company,

        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (ShippingCompany $shippingCompany) {
            factory(\App\Modules\Accounts\Entities\ShippingCompanyPrice::class)->create([
                'user_id' => $shippingCompany->id,
            ]);
        });
    }
}

