<?php

namespace App\View\Components;

use Illuminate\View\Component;

class OrderCreate extends Component
{
    public $serviceID;
    /**
     * Create a new component instance.
     * @param  string  $galleryID
     * @return void
     */
    public function __construct($serviceID)
    {
        $this->serviceID = $serviceID;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.order-create', ['serviceID' => 11]);
    }
}
