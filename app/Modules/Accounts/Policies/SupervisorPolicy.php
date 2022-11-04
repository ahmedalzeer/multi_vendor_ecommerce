<?php

namespace App\Modules\Accounts\Policies;

use App\Modules\Accounts\Entities\User;
use App\Modules\Accounts\Entities\Supervisor;
use Illuminate\Auth\Access\HandlesAuthorization;

class SupervisorPolicy
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
     * @param  \App\Modules\Accounts\Entities\Supervisor  $customer
     * @return mixed
     */
    public function view(User $user, Supervisor $supervisor)
    {
        return $user->isAdmin() || $user->is($supervisor);
    }

    /**
     * Determine whether the user can create Supervisors.
     *
     * @param  \App\Modules\Accounts\Entities\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can update the Supervisor.
     *
     * @param  \App\Modules\Accounts\Entities\User  $user
     * @param  \App\Modules\Accounts\Entities\Supervisor  $supervisor
     * @return mixed
     */
    public function update(User $user, Supervisor $supervisor)
    {
        return $user->isAdmin() || $user->is($supervisor);
    }

    /**
     * Determine whether the user can update the type of the Supervisor.
     *
     * @param  \App\Modules\Accounts\Entities\User  $user
     * @param  \App\Modules\Accounts\Entities\Supervisor  $supervisor
     * @return mixed
     */
    public function updateType(User $user, Supervisor $supervisor)
    {
        return $user->isAdmin() && $user->isNot($supervisor);
    }

    /**
     * Determine whether the user can delete the Supervisor.
     *
     * @param  \App\Modules\Accounts\Entities\User  $user
     * @param  \App\Modules\Accounts\Entities\Supervisor  $supervisor
     * @return mixed
     */
    public function delete(User $user, Supervisor $supervisor)
    {
        return $user->isAdmin() && $user->isNot($supervisor);
    }
}
