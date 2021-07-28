<?php

namespace App\Policies;

use App\Models\Admin\Expense;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ExpensePolicy
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
        return $user->userCanDo('Expense', 'browse');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin\Expense  $expense
     * @return mixed
     */
    public function view(User $user, Expense $expense)
    {
        return $user->userCanDo('Expense', 'read');
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->userCanDo('Expense', 'add');
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin\Expense  $expense
     * @return mixed
     */
    public function update(User $user, Expense $expense)
    {
        return $user->userCanDo('Expense', 'edit');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin\Expense  $expense
     * @return mixed
     */
    public function delete(User $user, Expense $expense)
    {
        return $user->userCanDo('Expense', 'delete');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin\Expense  $expense
     * @return mixed
     */
    public function restore(User $user, Expense $expense)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Admin\Expense  $expense
     * @return mixed
     */
    public function forceDelete(User $user, Expense $expense)
    {
        return true;
    }
}
