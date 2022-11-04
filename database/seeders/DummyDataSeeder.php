<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Modules\Offers\Database\Seeders\OfferTableSeeder;
use App\Modules\Orders\Database\Seeders\OrderTableSeeder;
use App\Modules\Stores\Database\Seeders\StoresTableSeeder;
use App\Modules\Coupons\Database\Seeders\CouponTableSeeder;
use App\Modules\Products\Database\Seeders\ProductTableSeeder;
use App\Modules\Categories\Database\Seeders\CategoriesTableSeeder;
use App\Modules\OrderStatuses\Database\Seeders\OrderStatusTableSeeder;
use App\Modules\Accounts\Database\Seeders\ShippingCompaniesTableSeeder;
use App\Modules\OrderProducts\Database\Seeders\OrderProductTableSeeder;
use App\Modules\Subscriptions\Database\Seeders\SubscriptionTableSeeder;
use App\Modules\CouponProducts\Database\Seeders\CouponProductTableSeeder;
use App\Modules\CustomFieldOptions\Database\Seeders\CustomFieldOptionTableSeeder;
use App\Modules\CustomFields\Database\Seeders\CustomFieldTableSeeder;
use App\Modules\Orders\Database\Seeders\OrderStatusUpdateTableSeeder;
use App\Modules\OrderProducts\Database\Seeders\OrderProductFieldValueTableSeeder;

class DummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(CountriesTableSeeder::class);
        $this->call(ShippingCompaniesTableSeeder::class);
        $this->call(StoresTableSeeder::class);
        $this->call(AddressesTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(ProductTableSeeder::class);
        $this->call(CustomFieldTableSeeder::class);
        $this->call(CustomFieldOptionTableSeeder::class);
        $this->call(SubscriptionTableSeeder::class);
        $this->call(CouponTableSeeder::class);
        $this->call(CouponProductTableSeeder::class);
        $this->call(OrderTableSeeder::class);
        $this->call(OrderProductTableSeeder::class);
        $this->call(OrderStatusTableSeeder::class);
        $this->call(OrderStatusUpdateTableSeeder::class);
        $this->call(OrderProductFieldValueTableSeeder::class);
        $this->call(OfferTableSeeder::class);
    }
}
