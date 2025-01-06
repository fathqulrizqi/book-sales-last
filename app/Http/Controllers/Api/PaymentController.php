<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentResource;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = Payment::all();
        return new PaymentResource(true, "Get All Resource", $payments);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            "order_id" => "required|exists:orders,id",
            "payment_method_id" => "required|exists:payment_methods,id",

        ]);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => $validator->errors()
            ], 422);
        }

        $order = Order::find($request->order_id);

        if (!$order) {
            return response()->json([
                "success" => false,
                "message" => "Order not found!"
            ], 404);
        }

        $amount = $order->total_amount;

        $payment = Payment::create([
            "order_id" => $request->order_id,
            "payment_method_id" => $request->payment_method_id,
            "amount" => $amount,
            "status" => "pending",
            "staff_confirmed_by" => null,
            "staff_confirmed_at" => null
        ]);

        return new PaymentResource(true, "Resource added successfully", $payment);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $payment = Payment::find($id);
        return new PaymentResource(true, "Get Resource", $payment);

        if (!$payment) {
            return response()->json([
                "success" => false,
                "message" => "Resource not found!"
            ], 404);
        }

        return new PaymentResource(true, "Get Resource", $payment);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $payment = Payment::find($id);

        if (!$payment) {
            return response()->json([
                "success" => false,
                "message" => "Payment tidak ditemukan!"
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            "status" => "required|in:pending,confirmed,failed"
        ]);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => $validator->errors()
            ], 422);
        }

        $user = auth('api')->user();

        // Cek apakah status pembayaran diubah menjadi 'confirmed' atau 'failed'
        if ($request->status === 'confirmed' || $request->status === 'failed') {
            // Menyimpan data staff yang mengonfirmasi pembayaran
            $data = [
                "status" => $request->status,
                "staff_confirmed_by" => $user->name,
                "staff_confirmed_at" => now(),
            ];

            // Update data pembayaran dengan status dan konfirmasi dari staff
            $payment->update($data);
        }

        return response()->json([
            "success" => true,
            "message" => "Resource berhasil diperbarui!",
            "data" => $payment
        ]);
    }



    public function destroy(string $id)
    {
        $payment = Payment::find($id);

        if (!$payment) {
            return response()->json([
                "success" => false,
                "message" => "Resource not found!"
            ], 404);
        }

        $payment->delete();

        return new PaymentResource(true, "Resource deleted successfully", $payment);
    }
}

