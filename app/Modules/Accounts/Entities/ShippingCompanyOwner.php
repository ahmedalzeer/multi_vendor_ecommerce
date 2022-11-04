<?php

namespace App\Modules\Accounts\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Modules\Accounts\Entities\Relations\CustomerRelations;
use App\Modules\Accounts\Entities\ShippingCompany;
use App\Modules\Accounts\Entities\User;
use Parental\HasParent;

class ShippingCompanyOwner extends User
{
    use HasParent, CustomerRelations;

    /**
     * Get the class name for polymorphic relations.
     *
     * @return string
     */
    public function getMorphClass()
    {
        return User::class;
    }

    /**
     * Get the default foreign key name for the model.
     *
     * @return string
     */
    public function getForeignKey()
    {
        return 'owner_id';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function ShippingCompanies()
    {
        return $this->hasMany(ShippingCompany::class);
    }
}
