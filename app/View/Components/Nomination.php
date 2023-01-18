<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Nomination as NominationTable;

class Nomination extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $nominations = NominationTable::all();
        return view('components.nomination',['nominations' => $nominations]);
    }
}
