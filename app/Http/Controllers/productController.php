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

    public function update(Request $request, $id)
{
    
    $product = Product::find($id);

    $validatedData = $request->validate([
        'name' => 'string|max:255',
        'description' => 'string',
        'price' => 'numeric|min:0',
        'product_details' => 'string|nullable',
        'ingredients' => 'string|nullable',
        'expiry_date' => 'date|nullable',
        'brand_name' => 'string|max:255|nullable',
        'rating' => 'numeric|min:0|max:5',
        'sub_category_id' => 'exists:sub_categories,id',
        'sizes' => 'array', 
        'sizes.*.size' => 'string',
        'sizes.*.price' => 'numeric|min:0',
        'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048' 
    ]);

    // تحديث بيانات المنتج
    $product->update($validatedData);

    // تحديث الصورة إذا تم رفع صورة جديدة
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('products', 'public');
        $product->image = $imagePath;
        $product->save();
    }

    return $this->successResponse($product, "Product updated successfully");
}

}
