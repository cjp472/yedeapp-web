<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Topic;

class TopicPolicy extends Policy
{
    /**
     * Check if the user is the owner of the topic before updating.
     * 
     * @param  App\Models\User  $currentUser
     * @param  App\Models\Topic  $topic
     * @return boolean
     */
    public function update(User $currentUser, Topic $topic)
    {
        return $currentUser->isAuthorOf($topic);
    }

    /**
     * Check if the user is the owner of the topic before deleting.
     * 
     * @param  App\Models\User  $currentUser
     * @param  App\Models\Topic  $topic
     * @return boolean
     */
    public function destroy(User $currentUser, Topic $topic)
    {
        return $currentUser->isAuthorOf($topic);
    }
}
