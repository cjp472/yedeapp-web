<?php

namespace App\Observers;

use App\User;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class VotableObserver
{
    public function created(User $user)
    {
        $user->vote()->create(['user_id' => $user->id]);
    }
}