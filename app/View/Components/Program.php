<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Program as ProgramTable;

class Program extends Component
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        Carbon::setLocale('ru');

        $program = ProgramTable::all()->sortBy('time')->sortBy('date')->groupBy('date');

//        foreach ($program as $date) {
//            foreach ($date as $item) {
//                foreach($item->speaker as $chel) {
//                    dump($chel->image);
//                }
//            }
//        }

        return view('components.program', ['list' => $program]);
    }
}
