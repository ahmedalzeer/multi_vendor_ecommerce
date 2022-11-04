<?php

namespace App\Modules\Accounts\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Modules\Accounts\Entities\ShippingCompany;
use App\Modules\Countries\Entities\City;

class ShippingCompanyPrice extends Model
{

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
//    protected $with = [
//        'ShippingCompany'
//    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $fillable = [
        'shipping_company_id',
        'city_id',
        'price',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function ShippingCompany()
    {
        return $this->belongsTo(ShippingCompany::class, 'shipping_company_id', 'id');
    }

    public function City()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }
}
