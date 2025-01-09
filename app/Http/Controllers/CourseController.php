<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        return view('courses.index');
    }

    public function show(Course $course)
    {
        return view('courses.show', compact('course'));
    }

    public function myCourses()
    {

        $courses = auth()->user()->courses_enrolled;

        return view('courses.my-courses', compact('courses'));
    }

    public function status(Course $course,  $lesson = null)
    {
        return view('courses.status');
    }
}
