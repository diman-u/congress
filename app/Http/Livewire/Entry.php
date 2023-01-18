<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Entry as EntryTable;
use App\Models\Event;

class Entry extends Component
{
    public $eventID = 1;

    public function render()
    {
        $events = Event::all();
        $entries = EntryTable::all();

        return view('livewire.entry',
            [
                'entries' => $entries,
                'events' => $events,
            ]
        );
    }
}
