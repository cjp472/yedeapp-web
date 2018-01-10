<?php

namespace App\Policies;

use App\User;
use App\Topic;

class TopicPolicy extends Policy
{
    /**
     * Check if the user has paid for the course.
     * 
     * @param  App\User  $currentUser
     * @param  App\Topic  $topic
     * @return boolean
     */
    public function show(User $currentUser, Topic $topic)
    {
        foreach($currentUser->subscriptions as $subscription) {
            if ($subscription->course_id == $topic->course->id) {
                return true;
            }
        }
        return false;
    }

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
