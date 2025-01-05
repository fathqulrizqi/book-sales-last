<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class OrderDetail extends Model
{
    protected $fillable = [
        'order_number',
        'customer_id',
        'book_id',
        'total_amount',
        'quantity',
        'status'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    // Relasi ke Book
    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }
}
