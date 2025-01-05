<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderDetailResource;
use App\Models\Order;
use App\Models\Book;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
{
    public function index()
    {
        // Ambil semua data Orders dengan relasi ke OrderDetails dan Book
        $orders = Order::with(['orderDetails.book'])->get();

        // Format data untuk response
        $formattedOrderDetails = $orders->map(function ($order) {
            return [
                'order_id' => $order->id,
                'book_id' => $order->book_id,
                'quantity' => $order->quantity,
                'price' => $order->total_amount,
                'status' => $order->status
            ];
        });

        return new OrderDetailResource(true, 'Get All Order Details', $formattedOrderDetails);
    }

    }


