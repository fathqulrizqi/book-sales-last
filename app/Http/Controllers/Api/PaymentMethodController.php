<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PaymentMethodResource;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PaymentMethodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paymentMethods = PaymentMethod::all();
        return new PaymentMethodResource(true, "Get All Resource", $paymentMethods);
    }

    /**
     * Show the form for creating a new resource.
     */

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|string",
            "account_number" => "required|regex:/^[0-9]+$/",
            "image" => "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048"
        ]);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => $validator->errors()
            ], 422);
        }

        $image = $request->file('image');
        $image->store('payment_methods', 'public');

        $paymentMethod = PaymentMethod::create([
            "name" => $request->name,
            "account_number" => $request->account_number,
            "image" => $image->hashName()
        ]);

        return new PaymentMethodResource(true, "Get All Resource", $paymentMethod);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $paymentMethod = PaymentMethod::find($id);
        return new PaymentMethodResource(true, "Get All Resource", $paymentMethod);

        if (!$paymentMethod) {
            return response()->json([
                "success" => false,
                "message" => "Resource not found!"
            ], 404);
        }

        return new PaymentMethodResource(true, "Get Resource", $paymentMethod);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $paymentMethod = PaymentMethod::find($id);

        if (!$paymentMethod) {
            return response()->json([
                "success" => false,
                "message" => "Resource not found!"
            ], 404);
        }

        $validator = Validator::make($request->all(), [
            "name" => "required|string",
            "account_number" => "required|regex:/^[0-9]+$/",
            "image" => "nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048"
        ]);

        if ($validator->fails()) {
            return response()->json([
                "success" => false,
                "message" => $validator->errors()
            ], 422);
        }

        $data = [
            "name" => $request->name,
            "account_number" => $request->account_number,
        ];

        if ($request->hasFile('image')) {
            $photo = $request->file('image');
            $photo->store('payment_methods', 'public');

            if ($paymentMethod->image) {
                Storage::disk('public')->delete('payment_methods/' . $paymentMethod->image);
            }

            $data['image'] = $photo->hashName();
        }
        $paymentMethod->update($data);


        return response()->json([
            "success" => true,
            "message" => "Resource updated successfully!",
            "data" => $paymentMethod
        ]);
    }

    public function destroy(string $id)
    {
        $paymentMethod = PaymentMethod::find($id);

        if (!$paymentMethod) {
            return response()->json([
                "success" => false,
                "message" => "Resource not found!"
            ], 404);
        }

        if ($paymentMethod->image) {
            Storage::disk('public')->delete('payment_methods/' . $paymentMethod->image);
        }

        $paymentMethod->delete();

        return new PaymentMethodResource(true, "Resource deleted successfully", $paymentMethod);
    }
}
