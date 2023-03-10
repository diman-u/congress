<?php

namespace App\View\Components\Account;

use Illuminate\View\Component;

class UserOrders extends Component
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
        $list = [];
        
        return view('components.account.user-orders', ['list' => $list]);
    }
}
