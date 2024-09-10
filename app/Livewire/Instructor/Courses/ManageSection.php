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

    public $sectionPositionCreate = [];

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

    public function storePosition($sectionId)
    {
        $this->validate([
            "sectionPositionCreate.{$sectionId}.name" => 'required'
        ]);
        $position = Section::find($sectionId)->position;
        Section::where('course_id', $this->course->id)
            ->where('position', '>=', $position)
            ->increment('position');
        $this->course->sections()->create([
            'name' => $this->sectionPositionCreate[$sectionId]['name'],
            'position' => $position

        ]);
        $this->getSections();
        $this->reset("sectionPositionCreate.{$sectionId}");
        $this->dispatch('close-section-position-create');
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

    public function sortSections($sorts)
    {
        foreach ($sorts as $position => $sectionId) {
            Section::find($sectionId)->update([
                'position' => $position + 1
            ]);
        }
        $this->getSections();
    }

    public function render()
    {
        return view('livewire.instructor.courses.manage-section');
    }
}
