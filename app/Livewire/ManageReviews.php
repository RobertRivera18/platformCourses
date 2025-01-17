<?php

namespace App\Livewire;

use App\Models\Review;
use Livewire\Component;

class ManageReviews extends Component
{

    public $course;
    public $reviews;

    public function mount()
    {
        $this->reviews = Review::where('course_id', $this->course->id)
            ->with('user')
            ->get();
    }
    public function render()
    {

        return view('livewire.manage-reviews');
    }
}
