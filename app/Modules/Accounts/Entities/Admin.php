<?php

namespace App\Modules\Accounts\Entities;

use App\Modules\Accounts\Entities\User;
use Parental\HasParent;

class Admin extends User
{
    use HasParent;

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
        return 'user_id';
    }
}
