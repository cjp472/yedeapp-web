<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Comment;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy extends Policy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Check if the user is the owner of the comment before deleting.
     * 
     * @param  App\Models\User  $currentUser
     * @param  App\Models\Comment  $comment
     * @return boolean
     */
    public function destroy(User $currentUser, Comment $comment)
    {
        // return $currentUser->isAuthorOf($comment);
        return false;
    }
}
