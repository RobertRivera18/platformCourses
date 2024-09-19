<?php

namespace App\Rules;

use Closure;
use App\Models\Lesson;
use Illuminate\Support\Str;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueLessonCourse implements ValidationRule
{
    public $courseId;

    public function __construct($courseId)
    {
        $this->$courseId = $courseId;
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $slug = Str::slug($value);
        $lesson = Lesson::where('slug', $slug)
            ->whereHas('section', function ($query) {
                $query->where('course_id', $this->courseId);
            })
            ->first();
        if ($lesson) {
            $fail('Ya existe una lección con este nombre en este curso');
        }
    }
}
