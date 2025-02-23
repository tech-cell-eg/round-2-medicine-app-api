<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubCategoryRequest;
use App\Models\Product;
use App\Traits\ApiResponseTrait;
use App\Traits\ProductHelperTrait;
use Illuminate\Http\Request;

class productController extends Controller
{
    use ApiResponseTrait;
    use ProductHelperTrait;

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

        public function listCategoryProducts($categoryId)
        {
            return $this->getCategoryWithProducts($categoryId);
        }
    
        public function listSubCategoryProducts($subCategoryName)
        {
            return $this->getSubCategoryWithProductsByName($subCategoryName);
        }
}
