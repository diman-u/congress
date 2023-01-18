<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Voronkovich\SberbankAcquiring\Client;
use Voronkovich\SberbankAcquiring\Currency;
use Voronkovich\SberbankAcquiring\OrderStatus;

class SberController extends Controller
{

    /**
     * Создание подключения
     */
    public static function initSberClient() {
        return new Client(
            [
                'userName' => env('SBER_USER'),
                'password' => env('SBER_PASSWORD'),
                'currency' => Currency::RUB,
            ]);
    }

    /**
     * Создать чек
     */
    public static function create($orderID, $orderAmount, $params) {
        $client = self::initSberClient();
        $returnUrl   = 'order/payment/success';
        $params['failUrl']  = 'order/payment/failure';
        $params['sessionTimeoutSecs']  = 1800;
        // $result = $client->registerOrder($orderID, $orderAmount, $returnUrl, $params);
    }
    
    /**
     * Получить статус заказа
     */
    public static function getOrderStatus($orderID) {
        $client = self::initSberClient();
        return true;
//        $result = $client->getOrderStatusByOwnId($orderID);
    }
    
    /**
     * Возврат
     */
    public function refund($orderId, $amountToRefund)
    {
        $client = $this->initSberClient();
//        $result = $client->refundOrder($orderId, $amountToRefund);
    }
}
