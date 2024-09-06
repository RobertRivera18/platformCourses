<?php

namespace App\Livewire\Instructor\Courses;

use App\Models\Section;
use Livewire\Component;

class ManageSection extends Component
{

    public $course;
    public $name;
    public $sections;
    public $sectionEdit = [
        'id' => null,
        'name' => null
    ];

    public function mount()
    {
        $this->getSections();
    }

    public function getSections()
    {
        $this->sections = Section::where('course_id', $this->course->id)
            ->orderBy('position', 'desc')
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
        $this->getSections();
    }

    public function edit(Section $section)
    {
        $this->sectionEdit = [
            'id' => $section->id,
            'name' => $section->name
        ];
    }

    public function update()
    {
        $this->validate([
            'sectionEdit.name' => 'required'
        ]);
        Section::find($this->sectionEdit['id'])->update([
            'name' => $this->sectionEdit['name']
        ]);
        $this->reset('sectionEdit');
        $this->getSections();
    }

    public function destroy(Section $section)
    {
        $section->delete();
        $this->getSections();
        $this->dispatch('swall', [
            'icon' => 'success',
            'text' => 'La sección ha sido eliminado con éxito',
            'timer' => 3000,
            'timerProgressBar' => true,
            'toast' => true,
            'position' => 'top-end',
            'showConfirmButton' => false
        ]);
    }

    public function render()
    {
        return view('livewire.instructor.courses.manage-section');
    }
}
