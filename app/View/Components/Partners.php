<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Partners as PartnersTable;

class Partners extends Component
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
        $list = PartnersTable::all();
        return view('components.partners', ['list' => $list]);
    }
}
