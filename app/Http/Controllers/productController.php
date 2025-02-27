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

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $subCategories = SubCategory::all();

        return view('edit-product', compact('product', 'subCategories'));
    }

    public function create()
    {
        $subCategories = SubCategory::all();
        return view('create_product', compact('subCategories'));
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric|min:0',
        'product_details' => 'nullable|string',
        'ingredients' => 'nullable|string',
        'expiry_date' => 'nullable|date',
        'brand_name' => 'nullable|string|max:255',
        'rating' => 'nullable|numeric|min:0|max:5',
        'old_price' => 'nullable|numeric|min:0',
        'sizes' => 'nullable|array',
        'sizes.*' => 'string|max:50',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'sub_category_id' => 'required|exists:sub_categories,id',
    ]);

    $productData = $request->except('image', 'sizes');
    
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('products', 'public');
        $productData['image'] = $imagePath;
    }

    if ($request->has('sizes')) {
        $productData['sizes'] = json_encode($request->sizes);
    }

    
    Product::create($productData);

    return redirect()->route('products')->with('success', 'Product created successfully!');
}


    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        $sizes = [];

        if ($request->has('sizes')) {
            foreach ($request->sizes as $sizeData) {
                if (!empty($sizeData['size']) && !empty($sizeData['price'])) {
                    $sizes[] = [
                        'size' => $sizeData['size'],
                        'price' => $sizeData['price']
                    ];
                }
            }
        }

        $product->sizes = json_encode($sizes, JSON_UNESCAPED_UNICODE);
        $product->save();



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

        $product->update($validatedData);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $product->image = $imagePath;
            $product->save();
        }

        return redirect()->route('products')->with('success', 'تم تحديث المنتج بنجاح');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(['message' => 'Product deleted successfully']);
    }


}
