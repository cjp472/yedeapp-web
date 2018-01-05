<?php

namespace App\Policies;

use App\User;
use App\Topic;

class TopicPolicy extends Policy
{
    /**
     * Check if the user is the owner of the topic before updating.
     * 
     * @param  App\User  $currentUser
     * @param  App\Topic  $topic
     * @return boolean
     */
    public function update(User $currentUser, Topic $topic)
    {
        return $currentUser->isAuthorOf($topic);
    }

    /**
     * Check if the user is the owner of the topic before deleting.
     * 
     * @param  App\User  $currentUser
     * @param  App\Topic  $topic
     * @return boolean
     */
    public function destroy(User $currentUser, Topic $topic)
    {
        return $currentUser->isAuthorOf($topic);
    }
}
