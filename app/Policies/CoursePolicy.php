<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CoursePolicy
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

    public function viewAny()
    {
        return true;
    }

    public function create()
    {
        return true;
    }

    public function update(User $user, Course $course)
    {
        return $course->instructor->is($user);
    }

    public function delete(User $user, Course $course)
    {
        return $course->instructor->is($user);
    }
}
