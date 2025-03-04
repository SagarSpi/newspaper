<?php

namespace App\Policies;

use App\Models\Backend\User;
use App\Models\Frontend\Comment;
use Illuminate\Auth\Access\Response;

class CommentPolicy
{
    
    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Comment $comment): bool
    {
        if ($user->status === 'Active') {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Comment $comment): bool
    {
        if ($user->status !== 'Active') {
            return false;
        }
        if (in_array($user->role,['Admin','Manager'])) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Comment $comment): bool
    {
        if ($user->status === 'Active' && in_array($user->role,['Admin','Manager'])) {
            return true;
        }
        return false;
    }
    public function deleteAll(User $user): bool
    {
        if ($user->status === 'Active' && in_array($user->role,['Admin','Manager'])) {
            return true;
        }
        return false;
    }
}
