<?php

namespace App\Policies;

use App\Models\Admin\Source;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SourcePolicy
{
    use HandlesAuthorization;

    public function before($user, $ability)
    {
        if ($user->isSuperAdmin()) {
            return true;
        }
    }


    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->userCanDo('Source', 'browse');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin\Source  $source
     * @return mixed
     */
    public function view(User $user, Source $source)
    {
        return $user->userCanDo('Source', 'read');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->userCanDo('Source', 'add');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin\Source  $source
     * @return mixed
     */
    public function update(User $user, Source $source)
    {
        return $user->userCanDo('Source', 'edit');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin\Source  $source
     * @return mixed
     */
    public function delete(User $user, Source $source)
    {
        return $user->userCanDo('Source', 'delete');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin\Source  $source
     * @return mixed
     */
    public function restore(User $user, Source $source)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin\Source  $source
     * @return mixed
     */
    public function forceDelete(User $user, Source $source)
    {
        return true;
    }
}
