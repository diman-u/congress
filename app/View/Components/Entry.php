<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Entry as EntryTable;

class Entry extends Component
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $entries = EntryTable::all();
        return view('components.entry', ['entries' => $entries]);
    }
}
