<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class productController extends Controller
{
    use ApiResponseTrait;

    public function index(){
        $products = Product::all();

        if ($products->isEmpty()) {
            return $this->errorResponse("No products found", 404);
        }

        return $this->successResponse($products, "Products retrieved successfully");
    }

    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return $this->errorResponse("Product not found", 404);
        }

        return $this->successResponse($product, "Product details retrieved successfully");
    }
}
