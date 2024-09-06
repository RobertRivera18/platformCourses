<?php

namespace App\Livewire\Instructor\Courses;

use App\Models\Requeriment;
use Livewire\Component;
use Livewire\Attributes\Validate;

class Requeriments extends Component
{
    public $course;
    public $requeriments;
    #[Validate('required|string|max:255')]
    public $name;

    
        public function mount()
        {
            $this->requeriments = Requeriment::where('course_id', $this->course->id)
                                               ->orderBy('position', 'asc')
                                               ->get()->toArray();
        }

        public function store()
        {
            $this->validate();
            $this->course->requeriments()->create([
                'name' => $this->name
            ]);
            $this->requeriments = Requeriment::where('course_id', $this->course->id)
                ->orderBy('position', 'asc')
                ->get()->toArray();
                 $this->reset('name');
        }

        public function update(){
        $this->validate([
            'requeriments.*.name' => 'required|string|max:255'
        ]);
        foreach ($this->requeriments as $requeriment) {
            Requeriment::find($requeriment['id'])->update([
                'name' => $requeriment['name']
            ]);
        }
        $this->dispatch('swall', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'Los requerimientos se han actualizado correctamente.'
        ]);
    }


    public function sortRequeriments($data)
    {
        foreach ($data as $index => $requerimentId) {
            Requeriment::find($requerimentId)->update([
                'position' => $index + 1
            ]);
        }
        $this->requeriments = Requeriment::where('course_id', $this->course->id)
        ->orderBy('position', 'asc')
        ->get()->toArray();
    }

    public function destroy($requerimentId)
    {
        Requeriment::find($requerimentId)->delete();
        $this->requeriments = Requeriment::where('course_id', $this->course->id)
                                         ->orderBy('position', 'asc')
                                         ->get()->toArray();
    }

    

    public function render()
    {
        return view('livewire.instructor.courses.requeriments');
    }
}
