<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $table = 'orders';
    protected $fillable = [
        'userID',
        'amount',
        'service_id',
        'order_status_id'
    ];

    public function order_status()
    {
        return $this->belongsTo(OrderStatus::class);
    }
}
