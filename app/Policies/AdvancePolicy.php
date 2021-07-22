<?php

namespace App\Policies;

use App\Models\Admin\Advance;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdvancePolicy
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
        return $user->userCanDo('Advance', 'browse');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin\Advance  $advance
     * @return mixed
     */
    public function view(User $user, Advance $advance)
    {
        return $user->userCanDo('Advance', 'read');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->userCanDo('Advance', 'add');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin\Advance  $advance
     * @return mixed
     */
    public function update(User $user, Advance $advance)
    {
        return $user->userCanDo('Advance', 'edit');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin\Advance  $advance
     * @return mixed
     */
    public function delete(User $user, Advance $advance)
    {
        return $user->userCanDo('Advance', 'delete');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin\Advance  $advance
     * @return mixed
     */
    public function restore(User $user, Advance $advance)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin\Advance  $advance
     * @return mixed
     */
    public function forceDelete(User $user, Advance $advance)
    {
        return true;
    }
}