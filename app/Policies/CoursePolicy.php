<?php

namespace App\Policies;

use App\User;
use App\Course;

class CoursePolicy extends Policy
{
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
     * Before updating, check if the user is the owner of a course.
     * 
     * @param  App\User  $currentUser
     * @param  App\Course  $course
     * @return boolean
     */
    public function update(User $currentUser, Course $course)
    {
        return $currentUser->isAuthorOf($course);
    }

    /**
     * Before deleting, check if the user is the owner of a course.
     * 
     * @param  App\User  $currentUser
     * @param  App\Course  $course
     * @return boolean
     */
    public function destroy(User $currentUseruser, Course $course)
    {
        return $currentUser->isAuthorOf($course);
    }
}
