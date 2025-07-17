<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable = [
        'total_price',
        'user_id',
        'status',
    ];
    protected $attributes = [
        'status' => OrderStatus::PENDING->value,
    ];

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class, 'order_id');
    }
}
