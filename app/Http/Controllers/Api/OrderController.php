<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function index() {
        $orders = Order::all();
        return new OrderResource(true, "Get All Resource", $orders);
    }

    public function store(Request $request) {
        // 1. validator
        $validator = Validator::make($request->all(), [
            'book_id' => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1'
        ]);

        // 2. check validator
        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => $validator->errors()
            ], 422);
        }

        // 3. insert data
        Order::create([
            'order_number' => '',
            'customer_id' => '',
            'book_id' => $request->book_id,
            'total_amount' => '',
            'status' => '',
        ]);
        // 4. return response
    }
}
