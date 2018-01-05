<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Vote;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class UserObserver
{
    public function created(User $user)
    {
        // No need for cascade on deleting, db will do that
        $user->vote()->create(['user_id' => $user->id]);
    }
}