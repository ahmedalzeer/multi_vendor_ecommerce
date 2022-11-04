<?php


namespace App\Modules\Accounts\Entities\Relations;


use App\Modules\Accounts\Entities\Address;

trait CustomerRelations
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function addresses()
    {
        return $this->hasMany(Address::class);
    }
}
