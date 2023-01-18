<?php

namespace App\Console;

use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Order;
use App\Http\Controllers\OrderController;

class ConsoleCommandSber {

    public function __invoke()
    {
        Log::alert('Orders Sber update');
        (new OrderController())->getOrdersByUpdate();
    }
}