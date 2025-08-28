<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'order_id',
        'amount',
        'payment_method',
        // 'status',
        'payment_date',
        'transaction_id',
        // 'payment_gateway',
    ];
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
