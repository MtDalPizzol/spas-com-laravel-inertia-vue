<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\Section;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SectionPolicy
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

    public function viewAny(User $user, Course $course)
    {
        return $user->can('update', $course);
    }

    public function create(User $user, Course $course)
    {
        return $user->can('update', $course);
    }

    public function update(User $user, Section $section)
    {
        return $user->can('update', $section->course);
    }

    public function delete(User $user, Section $section)
    {
        return $user->can('update', $section->course);
    }
}
