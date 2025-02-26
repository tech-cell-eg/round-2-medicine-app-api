<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubCategoryRequest;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Product;
use App\Models\SubCategory;
use App\Traits\ApiResponseTrait;
use App\Traits\ProductHelperTrait;
use Illuminate\Http\Request;

class productController extends Controller
{
    use ApiResponseTrait;
    use ProductHelperTrait;

    public function index()
    {
        $products = Product::all();
        
        if ($products->isEmpty()) {
            return $this->errorResponse("No products found", 404);
        }

        return $this->successResponse($products, "Products retrieved successfully");
    }

    public function show($id)
    {
        $product = Product::with('comments')->find($id);

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

    public function viewProducts()
    { {
            $products = Product::with(['subCategory.category'])->paginate(10);
            return view('products', compact('products'));
        }
    }

    public function viewProductDetails($id)
    {
        $product = Product::with('subcategory.category')->findOrFail($id);

        return view('product-details', compact('product'));
    }

    public function edit($id){
        $product = Product::findOrFail($id);
        $subCategories = SubCategory::all();

        return view('edit-product' , compact('product' ,  'subCategories'));
    }
}
