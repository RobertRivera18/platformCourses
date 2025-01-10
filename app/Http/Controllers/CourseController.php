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

    public function status(Course $course, Lesson $lesson = null)
    {
        if (!$lesson) {
            $course->load(['sections' => function ($query) {
                $query->orderBy('position', 'asc')
                    ->with('lessons', function ($query) {
                        $query->orderBy('position', 'asc')
                            ->where('is_published', true);
                    });
            }]);

            $lesson = $course->sections->pluck('lessons')->collapse()->first();
            return redirect()->route('courses.status', [$course, $lesson]);
        }
    
        return view('courses.status', compact('course','lesson'));
    }
}
