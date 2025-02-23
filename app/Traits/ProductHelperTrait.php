<?php

namespace App\Traits;

use App\Models\Category;
use App\Models\SubCategory;

trait ProductHelperTrait
{
    public function getCategoryWithProducts($categoryId)
    {
        $category = Category::with('subCategories.products')->find($categoryId);

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        return response()->json([
            'category' => $category->name,
            'sub_categories' => $category->subCategories->map(function ($subCategory) {
                return [
                    'sub_category' => $subCategory->name,
                    'products' => $subCategory->products
                ];
            }),
        ]);
    }


    public function getSubCategoryWithProductsByName($subCategoryName)
    {
        $subCategory = SubCategory::with('products')->where('name', $subCategoryName)->first();

        if (!$subCategory) {
            return response()->json(['message' => 'SubCategory not found'], 404);
        }

        return response()->json([
            'sub_category' => $subCategory->name,
            'products' => $subCategory->products
        ]);
    }
}
