<?php

namespace App\Http\Livewire;

use App\Models\ExpertReview as ExpertReviewTable;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ExpertReview extends Component
{
    public function grade($nomination_id, $grade)
    {
        ExpertReviewTable::updateOrCreate([
            'nomination_id' => $nomination_id,
            'user_id' => Auth::id()
        ], [
            'body' => '',
            'rating' => $grade
        ]);
    }

    public function render()
    {
        return view('livewire.expert-review');
    }
}
