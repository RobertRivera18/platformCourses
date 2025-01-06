<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Course;

class CoursePolicy
{
    public function enrolled(User $user ,Course $course){
  return $user->courses_enrolled->contains($course);
    }
}
