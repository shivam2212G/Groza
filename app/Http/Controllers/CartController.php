<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    // Add to Cart
    public function addToCart(Request $request)
    {
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'product_id' => 'required|exists:products,product_id',
    ]);

    // Check if product already in cart
    $existingCartItem = Cart::where('user_id', $request->user_id)
                            ->where('product_id', $request->product_id)
                            ->first();

    if ($existingCartItem) {
        return response()->json([
            'success' => false,
            'message' => 'Product already in cart'
        ], 400);
    }

    $cartItem = Cart::create([
        'user_id' => $request->user_id,
        'product_id' => $request->product_id,
    ]);

    return response()->json([
        'success' => true,
        'message' => 'Product added to cart successfully',
        'data' => $cartItem
    ], 201);
    }

    // Remove from Cart
    public function removeFromCart(Request $request)
    {
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'product_id' => 'required|exists:products,product_id',
    ]);

    $deleted = Cart::where('user_id', $request->user_id)
                  ->where('product_id', $request->product_id)
                  ->delete();

    if ($deleted) {
        return response()->json([
            'success' => true,
            'message' => 'Product removed from cart successfully'
        ]);
    }

    return response()->json([
        'success' => false,
        'message' => 'Product not found in cart'
    ], 404);
    }

    public function getCartItems($userId)
{
    try {
        $cartItems = Cart::select(
                'carts.cart_id',
                'carts.user_id',
                'carts.product_id',
                'products.*',
                'carts.created_at',
                'carts.updated_at'
            )
            ->join('products', 'carts.product_id', '=', 'products.product_id')
            ->where('carts.user_id', $userId)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $cartItems
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Failed to retrieve cart items',
            'error' => $e->getMessage()
        ], 500);
    }
}

}
