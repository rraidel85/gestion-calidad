<?php

namespace App\Policies;

use App\Models\User;
use App\Models\TypeArea;
use Illuminate\Auth\Access\HandlesAuthorization;

class TypeAreaPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the typeArea can view any models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->hasPermissionTo('listar tipos de área');
    }

    /**
     * Determine whether the typeArea can view the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TypeArea  $model
     * @return mixed
     */
    public function view(User $user, TypeArea $model)
    {
        return $user->hasPermissionTo('ver tipos de área');
    }

    /**
     * Determine whether the typeArea can create models.
     *
     * @param  App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->hasPermissionTo('crear tipos de área');
    }

    /**
     * Determine whether the typeArea can update the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TypeArea  $model
     * @return mixed
     */
    public function update(User $user, TypeArea $model)
    {
        return $user->hasPermissionTo('editar tipos de área');
    }

    /**
     * Determine whether the typeArea can delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TypeArea  $model
     * @return mixed
     */
    public function delete(User $user, TypeArea $model)
    {
        return $user->hasPermissionTo('eliminar tipos de área');
    }

    /**
     * Determine whether the user can delete multiple instances of the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TypeArea  $model
     * @return mixed
     */
    public function deleteAny(User $user)
    {
        return $user->hasPermissionTo('eliminar tipos de área');
    }

    /**
     * Determine whether the typeArea can restore the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TypeArea  $model
     * @return mixed
     */
    public function restore(User $user, TypeArea $model)
    {
        return false;
    }

    /**
     * Determine whether the typeArea can permanently delete the model.
     *
     * @param  App\Models\User  $user
     * @param  App\Models\TypeArea  $model
     * @return mixed
     */
    public function forceDelete(User $user, TypeArea $model)
    {
        return false;
    }
}
