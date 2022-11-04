<?php

namespace App\Modules\Accounts\Policies;

use App\Modules\Accounts\Entities\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Modules\Accounts\Entities\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Modules\Accounts\Entities\User  $user
     * @param  \App\Modules\Accounts\Entities\User  $model
     * @return mixed
     */
    public function view(User $user, User $model)
    {
        return $user->isAdmin() || $user->is($model);
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Modules\Accounts\Entities\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->isAdmin();
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Modules\Accounts\Entities\User  $user
     * @param  \App\Modules\Accounts\Entities\User  $model
     * @return mixed
     */
    public function update(User $user, User $model)
    {
        return $user->isAdmin() || $user->is($model);
    }

    /**
     * Determine whether the user can update the type of the model.
     *
     * @param  \App\Modules\Accounts\Entities\User  $user
     * @param  \App\Modules\Accounts\Entities\User  $model
     * @return mixed
     */
    public function updateType(User $user, User $model)
    {
        return $user->isAdmin() && $user->isNot($model);
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Modules\Accounts\Entities\User  $user
     * @param  \App\Modules\Accounts\Entities\User  $model
     * @return mixed
     */
    public function delete(User $user, User $model)
    {
        return $user->isAdmin() && $user->isNot($model);
    }
}
