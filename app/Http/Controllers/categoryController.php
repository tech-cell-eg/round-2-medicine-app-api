<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class categoryController extends Controller
{
    use ApiResponseTrait;
    public function index(){
        $categories = Category::all();

        if ($categories->isEmpty()) {
            return $this->errorResponse("No categories found", 404);
        }

        return $this->successResponse($categories, "Categories retrieved successfully");
    }
}
