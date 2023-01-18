<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Nomination;
use App\Models\EntryLike as EntryLikeTable;
use Illuminate\Support\Facades\Auth;

class EntryLike extends Component
{
    public function like(Nomination $nomination)
    {
        $user = Auth::user();
        $user->like($nomination);
    }

    public function dislike(Nomination $nomination) {
        $user = Auth::user();
        $user->unlike($nomination);
    }

    public function render()
    {
        foreach (Nomination::all() as $item) {
            $item->userlike = Auth::user()->hasLiked($item);
            $item->likers = $item->likers()->count();
            $nominations[] = $item;
        }

        return view(
            'livewire.entry-like',
            [
                'nominations' => $nominations
            ]
        );
    }
}
