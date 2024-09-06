<?php

namespace App\Livewire\Instructor\Courses;

use App\Models\Section;
use Livewire\Component;

class ManageSection extends Component
{

    public $course;
    public $name;

    public $sections;

    public function mount()
    {
        $this->sections = Section::where('course_id',$this->course->id)
          ->orderBy('position','desc')
           ->get();
    }
    public function store()
    {
        $this->validate([
            'name' => 'required'

        ]);
        $this->course->sections()->create([
            'name' => $this->name,
        ]);
        $this->reset('name');
    }

    public function render()
    {
        return view('livewire.instructor.courses.manage-section');
    }
}
