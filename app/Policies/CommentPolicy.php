<?php

namespace App\Policies;

use App\User;
use App\Comment;
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
     * @param  App\User  $currentUser
     * @param  App\Comment  $comment
     * @return boolean
     */
    public function destroy(User $currentUser, Comment $comment)
    {
        // return $currentUser->isAuthorOf($comment);
        return false;
    }
}
