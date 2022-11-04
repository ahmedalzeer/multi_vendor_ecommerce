<?php

namespace App\Modules\Accounts\Database\Seeders;

use App\Modules\Accounts\Entities\Customer;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class AddressesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $usersIDs = Customer::pluck('id');
        $cnt =0;
        foreach ($usersIDs as $usersID) {
            factory(\App\Modules\Accounts\Entities\Address::class)->create([
                'user_id' => $usersID,
                'city_id' => ++$cnt,
            ]);
            factory(\App\Modules\Accounts\Entities\Address::class)->create([
                'user_id' => $usersID,
                'city_id' => $cnt,
            ]);
        }
    }
}
