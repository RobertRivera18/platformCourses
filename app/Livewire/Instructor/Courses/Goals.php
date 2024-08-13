<?php

namespace App\Livewire\Instructor\Courses;

use App\Models\Goal;
use Livewire\Component;
use Livewire\Attributes\Validate;

class Goals extends Component
{
    public $course;
    public $goals;
    #[Validate('required|string|max:255')]
    public $name;


    public function mount()
    {
        $this->goals = Goal::where('course_id', $this->course->id)->get()->toArray();
    }


    public function store()
    {
        $this->validate();
        $this->course->goals()->create([
            'name' => $this->name
        ]);
        $this->goals = Goal::where('course_id', $this->course->id)->get()->toArray();
        $this->reset('name');
    }

    public function update()
    {
        $this->validate([
            'goals.*.name' => 'required|string|max:255'
        ]);
        foreach ($this->goals as $goal) {
            Goal::find($goal['id'])->update([
                'name' => $goal['name']
            ]);
        }
        $this->dispatch('swall', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'Los objetivos se han actualizado correctamente'
        ]);
    }

    public function destroy($goalId)
    {
        Goal::find($goalId)->delete();
        $this->goals = Goal::where('course_id', $this->course->id)->get()->toArray();
        
    }

    public function render()
    {
        return view('livewire.instructor.courses.goals');
    }
}
