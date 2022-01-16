<?php

namespace App\Policies;

use App\Models\Area;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AreaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the area can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('list areas');
    }

    /**
     * Determine whether the area can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Area  $model
     * @return mixed
     */
    public function view(User $user, Area $model)
    {
        return $user->hasPermissionTo('view areas');
    }

    /**
     * Determine whether the area can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('create areas');
    }

    /**
     * Determine whether the area can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Area  $model
     * @return mixed
     */
    public function update(User $user, Area $model)
    {
        return $user->hasPermissionTo('update areas');
    }

    /**
     * Determine whether the area can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Area  $model
     * @return mixed
     */
    public function delete(User $user, Area $model)
    {
        return $user->hasPermissionTo('delete areas');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Area  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('delete areas');
    }

    /**
     * Determine whether the area can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Area  $model
     * @return mixed
     */
    public function restore(User $user, Area $model)
    {
        return false;
    }

    /**
     * Determine whether the area can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\Area  $model
     * @return mixed
     */
    public function forceDelete(User $user, Area $model)
    {
        return false;
    }
}
