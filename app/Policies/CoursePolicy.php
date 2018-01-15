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
