<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class cartController extends Controller
{

    use ApiResponseTrait;

    public function index()
    {
        $userId = auth()->id();

        $cartItems = Cart::where('user_id', $userId)->with('product')->get();

        if ($cartItems->isEmpty()) {
            return $this->errorResponse('Your cart is empty', 404);
        }

        return $this->successResponse($cartItems, 'Cart products retrieved successfully');
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $userId = auth()->id(); 
        $product = Product::find($request->product_id);

        if (!$product) {
            return $this->errorResponse("Product not found", 404);
        }

        $cartItem = Cart::where('user_id', $userId)
                        ->where('product_id', $product->id)
                        ->first();

        if ($cartItem) {
            $this->errorResponse('this product already exits in the cart' , 409);
        } else {

            Cart::create([
                'user_id' => $userId,
                'product_id' => $product->id,

            ]);
            
            return $this->successResponse(null, "Product added to cart successfully");
        }

    }
}
