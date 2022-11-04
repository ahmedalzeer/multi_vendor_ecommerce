<?php

namespace App\Modules\Accounts\Database\factories;

use App\Modules\Accounts\Entities\ShippingCompanyOwner;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ShippingCompanyOwnerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Modules\Accounts\Entities\ShippingCompanyOwner::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => fake()->name,
            'email' => fake()->unique()->safeEmail,
            'phone' => fake()->unique()->phoneNumber,
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (ShippingCompanyOwner $shippingCompanyOwner) {
            factory(\App\Modules\Accounts\Entities\ShippingCompany::class)->create([
                'user_id' => $shippingCompanyOwner->id,
            ]);
        });
    }
}

