<?php

namespace App\Policies;

use App\Models\Backend\Article;
use App\Models\Backend\User;

class ArticlePolicy
{

    // public function before(User $user): bool|null 
    // {
    //     if ($user->isAuthorise()) {
    //         return true;
    //     }
    //     return null;
    // }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Article $article): bool
    {
        if ($user->status === 'Active') {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {   
        if ($user->status === 'Active' && in_array($user->role,['Admin','Manager','Reporter'])) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Article $article): bool
    {

        if ($user->status !== 'Active') {
            return false;
        }

        if (in_array($user->role,['Admin','Manager'])) {
            return true;
        }
        if ($user->role === 'Reporter' && $user->id === $article->user_id) {
            return true;
        }
        return false;
        
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user,): bool
    {   
        if ($user->status === 'Active' && in_array($user->role,['Admin','Manager'])) {
            return true;
        }

        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function approved(User $user): bool
    {
        if ($user->status === 'Active' && in_array($user->role,['Admin','Manager'])) {
            return true;
        }

        return false;
    }
}
