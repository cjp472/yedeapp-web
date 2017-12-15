<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
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
     * Restraint the user profile update action. This func accepts two params.
     * First, the current logged user instance. Second, the user instance who
     * is updating their profile. If they are the same one, they are updating
     * their own profile, and the policy pass the update action. If not, block.
     * 
     * @param  App\Models\User  $currentUser
     * @param  App\Models\User  $user
     * @return boolean
     */
    public function update(User $currentUser, User $user)
    {
        return $currentUser->id === $user->id;
    }
}
