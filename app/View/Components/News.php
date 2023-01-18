<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\News as NewsTable;

class News extends Component
{
    public $count;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($count)
    {
        $this->count = $count;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $list = NewsTable::latest()->limit($this->count)->get();
        return view('components.news', ['list' => $list]);
    }
}
