<?php

namespace App\Modules\Accounts\Entities;

use App\Http\Filters\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Modules\Accounts\Entities\Customer;
use App\Modules\Countries\Entities\City;

class Address extends Model
{
    use Filterable;

    protected $fillable = [
        'address',
        'city_id',
        'is_primary',
    ];

    /**
     * to make eager loading when get model.
     * @var string[]
     */
    protected $with = [
        'customer',
    ];

    public function getForeignKey()
    {
        return  'address_id';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
