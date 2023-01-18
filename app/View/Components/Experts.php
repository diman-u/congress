<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Speaker;

class Experts extends Component
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
        $list = Speaker::all();
        return view('components.experts', ['list' => $list]);
    }
}
