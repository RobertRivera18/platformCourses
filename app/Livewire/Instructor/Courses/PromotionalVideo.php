<?php

namespace App\Livewire\Instructor\Courses;

use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class PromotionalVideo extends Component
{
    use WithFileUploads;

    public $course;
    #[Validate('required', 'mimeTypes:video/*')]
    public $video;

    public function save()
    {
        $this->validate();
        $this->course->video_path = $this->video->store('courses/promotional-videos');
        $this->course->save();
        return $this->redirectRoute('instructor.courses.video', $this->course, true, true);
    }
    public function render()
    {
        return view('livewire.instructor.courses.promotional-video');
    }
}
