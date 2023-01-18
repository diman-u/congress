<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order as OrderTable;
use App\Http\Controllers\SberController as Sber;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\Services;

class OrderController extends Controller
{
    const PAYMENT_MAX_DAYS = 7;

    /**
     * Создать заказ
     */
    public function confirm($service_id) {
        $userID = Auth::id();
        $service = Services::find($service_id);
        $orderAmount = $service->amount;

        $orderID = $this->createOrder($userID, $orderAmount, $service_id);
        $cart = $this->preparePayment($service_id, $orderAmount);

        if (!empty($orderID)) {
            $answer = Sber::create($orderID, $orderAmount, $cart);
        }

        if (!empty($answer)) {
            return redirect($answer['formUrl']);
        }
    }

    public function preparePayment($service_id, $orderAmount)
    {
        $cart = [];
        $cart['orderBundle']['cartItems']['items'][] = [
            'positionId' => 1,
            'name' => 'Услуга 1',
            'quantity' => [
                'value' => $service_id,
                'measure' => 'услуга',
            ],
            'itemCode' => 1,
            'itemPrice' => ( intval($orderAmount) * 100 ),
            'itemAmount' => ( intval($orderAmount) * 100 )
        ];

        $cart['orderBundle'] = json_encode($cart['orderBundle']);

        return $cart;
    }

    public function getOrdersByUpdate()
    {
        $orders = OrderTable::where('order_status_id', '=', 2)
            ->where('created_at', '>', Carbon::now()->subDays(self::PAYMENT_MAX_DAYS))
            ->orderBy('updated_at')
            ->limit(5)
            ->get();

        foreach ($orders as $item) {
            if (Sber::getOrderStatus($item->id)) {
                $item->order_status_id = 3;
            }

            $item->touch();
        }
    }

    public function createOrder($userID, $orderAmount, $service_id) {

        $res = OrderTable::create([
            'userID' => $userID,
            'amount' => $orderAmount,
            'service_id' => $service_id,
            'order_status_id' => 1,
        ]);

        if (!empty($res->id)) {
            return $res->id;
        } else {
            return false;
        }
    }
}
