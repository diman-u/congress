<?php

namespace App\View\Components\Account;

use App\Models\Entry;
use Illuminate\View\Component;

class UserEntries extends Component
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
        $list = Entry::where('user_id', auth()->id())->get();

        return view('components.account.user-entries', ['list' => $list]);
    }
}
