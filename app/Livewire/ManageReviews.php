<?php

namespace App\Livewire;

use App\Models\Review;
use Livewire\Component;

class ManageReviews extends Component
{

    public $course;
    public $reviews;
    public $editReview = [
        'open' => false,
        'id' => null,
        'rating' => 5,
        'comment' => '',
    ];

    public function mount()
    {
        $this->reviews = Review::where('course_id', $this->course->id)
            ->with('user')
            ->get();
    }

    public function edit(Review $review)
    {
        $this->editReview = [
            'open' => true,
            'id' => $review->id,
            'rating' => $review->rating,
            'comment' => $review->comment
        ];
    }

    public function update()
    {
        $this->validate([
            'editReview.rating' => 'required',
            'editReview.comment' => 'required'
        ]);
        $review = Review::find($this->editReview['id']);
        $review->update([
            'rating' => $this->editReview['rating'],
            'comment' => $this->editReview['comment']
        ]);
        $this->reviews = Review::where('course_id', $this->course->id)
            ->with('user')
            ->get();

        $this->reset('editReview');
    }

    public function delete(Review $review)
    {
        $review->delete();
        $this->reviews = Review::where('course_id', $this->course->id)
            ->with('user')
            ->get();
    }
    public function render()
    {

        return view('livewire.manage-reviews');
    }
}
