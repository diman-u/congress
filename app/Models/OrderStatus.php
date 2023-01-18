<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderStatus extends Model
{
    use CrudTrait;
    use HasFactory;

    protected $table = 'order_status';
    protected $fillable = [
        'title',
    ];

    public function order()
    {
        return $this->belongsToMany(Order::class);
    }
}
