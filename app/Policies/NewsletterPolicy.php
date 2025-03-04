<?php

namespace App\Policies;

use App\Models\Backend\User;
use App\Models\Frontend\Newsletter;
use Illuminate\Auth\Access\Response;

class NewsletterPolicy
{

    public function send(User $user): bool
    {
        if ($user->status === 'Active' && in_array($user->role,['Admin','Manager'])) {
            return true;
        }
        return false;
    }
    
    public function sendAll(User $user, Newsletter $newsletter): bool
    {
        if ($user->status === 'Active' && in_array($user->role,['Admin','Manager'])) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Newsletter $newsletter): bool
    {
        if ($user->status === 'Active' && in_array($user->role,['Admin','Manager'])) {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Newsletter $newsletter): bool
    {
        if ($user->status === 'Active' && in_array($user->role,['Admin','Manager'])) {
            return true;
        }
        return false;
    }
}
