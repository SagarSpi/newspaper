<?php

namespace App\Policies;

use App\Models\Backend\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        if ($user->status === 'Active') {
            return true;
        }
        return false;
    }
    public function approved(User $user, User $model): bool
    {
        if ($user->status === 'Active' && $user->role === 'Admin') {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        if ($user->status === 'Active' && in_array($user->role,['Admin','Manager'])) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        if ($user->status === 'Active' && $user->role === 'Admin') {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function deleteAll(User $user, User $model): bool
    {
        if ($user->status === 'Active' && $user->role === 'Admin') {
            return true;
        }
        return false;
    }
}
