<?php

namespace App\Http\Controllers;

use App\Models\Checkout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CheckoutController extends Controller
{
     public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:users,id',
            'product_data' => 'required|json',
            'total' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $checkout = Checkout::create([
                'user_id' => $request->user_id,
                'product_data' => $request->product_data,
                'total' => $request->total,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Checkout created successfully',
                'data' => $checkout
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create checkout',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // In CheckoutController.php
    public function index($userId)
    {
        $checkouts = Checkout::where('user_id', $userId)
                    ->orderBy('created_at', 'desc')
                    ->get();

         return response()->json([
            'success' => true,
            'data' => $checkouts
        ]);
    }
}
