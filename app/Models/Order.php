<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_number',
        'customer_id',
        'book_id',
        'total_amount',
        'status'
    ];

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }

    // Relasi ke OrderDetail
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }
}
