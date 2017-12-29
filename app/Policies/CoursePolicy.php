<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Course;

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
     * @param  App\Models\User  $currentUser
     * @param  App\Models\Course  $course
     * @return boolean
     */
    public function update(User $currentUser, Course $course)
    {
        return $currentUser->id === $course->user_id;
    }

    /**
     * Before deleting, check if the user is the owner of a course.
     * 
     * @param  App\Models\User  $currentUser
     * @param  App\Models\Course  $course
     * @return boolean
     */
    public function destroy(User $currentUseruser, Course $course)
    {
        return $currentUser->id === $course->user_id;
    }
}
