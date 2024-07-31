<?php

namespace App\Policies;

use App\Models\Idea;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class IdeaPolicy
{

    /**
     * Determine whether the user can update the idea (Model).
     */
    public function update(User $user, Idea $idea): bool
    {
        // update check if its admin or current user
        return ($user->is_admin || $user->is($idea->user));
    }

    /**
     * Determine whether the user can delete the idea(Model).
     */
    public function delete(User $user, Idea $idea): bool
    {
        //destroy check if its admin or current user
        return ($user->is_admin || $user->is($idea->user));
    }
}
