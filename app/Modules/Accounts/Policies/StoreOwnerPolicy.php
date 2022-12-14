<?php

namespace App\Modules\Accounts\Policies;

use App\Modules\Accounts\Entities\User;
use App\Modules\Accounts\Entities\StoreOwner;
use Illuminate\Auth\Access\HandlesAuthorization;

class StoreOwnerPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any customers.
     *
     * @param  \App\Modules\Accounts\Entities\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can view the customer.
     *
     * @param  \App\Modules\Accounts\Entities\User  $user
     * @param  \App\Modules\Accounts\Entities\StoreOwner  $customer
     * @return mixed
     */
    public function view(User $user, StoreOwner $storeOwner)
    {
        return $user->isAdmin() || $user->is($storeOwner);
    }

    /**
     * Determine whether the user can create StoreOwners.
     *
     * @param  \App\Modules\Accounts\Entities\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can update the StoreOwner.
     *
     * @param  \App\Modules\Accounts\Entities\User  $user
     * @param  \App\Modules\Accounts\Entities\StoreOwner  $storeOwner
     * @return mixed
     */
    public function update(User $user, StoreOwner $storeOwner)
    {
        return $user->isAdmin() || $user->is($storeOwner);
    }

    /**
     * Determine whether the user can update the type of the StoreOwner.
     *
     * @param  \App\Modules\Accounts\Entities\User  $user
     * @param  \App\Modules\Accounts\Entities\StoreOwner  $storeOwner
     * @return mixed
     */
    public function updateType(User $user, StoreOwner $storeOwner)
    {
        return $user->isAdmin() && $user->isNot($storeOwner);
    }

    /**
     * Determine whether the user can delete the StoreOwner.
     *
     * @param  \App\Modules\Accounts\Entities\User  $user
     * @param  \App\Modules\Accounts\Entities\StoreOwner  $storeOwner
     * @return mixed
     */
    public function delete(User $user, StoreOwner $storeOwner)
    {
        return $user->isAdmin() && $user->isNot($storeOwner);
    }
}
