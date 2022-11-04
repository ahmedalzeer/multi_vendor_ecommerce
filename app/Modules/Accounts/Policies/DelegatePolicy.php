<?php

namespace App\Modules\Accounts\Policies;

use App\Modules\Accounts\Entities\User;
use App\Modules\Accounts\Entities\Delegate;
use Illuminate\Auth\Access\HandlesAuthorization;

class DelegatePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any Delegates.
     *
     * @param  \App\Modules\Accounts\Entities\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can view the Delegate.
     *
     * @param  \App\Modules\Accounts\Entities\User  $user
     * @param  \App\Modules\Accounts\Entities\Delegate  $delegate
     * @return mixed
     */
    public function view(User $user, Delegate $delegate)
    {
        return $user->isAdmin() || $user->is($delegate);
    }

    /**
     * Determine whether the user can create Delegates.
     *
     * @param  \App\Modules\Accounts\Entities\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can update the Delegate.
     *
     * @param  \App\Modules\Accounts\Entities\User  $user
     * @param  \App\Modules\Accounts\Entities\Delegate  $delegate
     * @return mixed
     */
    public function update(User $user, Delegate $delegate)
    {
        return $user->isAdmin() || $user->is($delegate);
    }

    /**
     * Determine whether the user can update the type of the Delegate.
     *
     * @param  \App\Modules\Accounts\Entities\User  $user
     * @param  \App\Modules\Accounts\Entities\Delegate  $delegate
     * @return mixed
     */
    public function updateType(User $user, Delegate $delegate)
    {
        return $user->isAdmin() && $user->isNot($delegate);
    }

    /**
     * Determine whether the user can delete the Delegate.
     *
     * @param  \App\Modules\Accounts\Entities\User  $user
     * @param  \App\Modules\Accounts\Entities\Delegate  $delegate
     * @return mixed
     */
    public function delete(User $user, Delegate $delegate)
    {
        return $user->isAdmin() && $user->isNot($delegate);
    }
}
