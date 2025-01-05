<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{

    protected $fillable = [
        'order_id',
        'payment_method_id',
        'amount',
        'status',
        'staff_confirmed_by',
        'staff_confirmed_at',
    ];

    // Relasi dengan model Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Relasi dengan model PaymentMethod
    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

}
