@extends('layouts.main')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="card-title">Edit Product</div>
    </div>
    <div class="card-body">
        <div class="form-group">
            <label for="squareInput">Name</label>
            <input type="text" name="name" class="form-control input-square" id="squareInput" placeholder="Square Input" value="{{$product->name}}">
        </div>
        <div class="form-group">
            <label for="comment">Description</label>
            <textarea class="form-control" id="comment" rows="5" name="description" value={{$product->description}}>

            </textarea>
        </div>
        <div class="form-group">
            <label for="squareInput">Price</label>
            <input type="text" name="price" class="form-control input-square" id="squareInput" placeholder="Square Input" value={{$products->price}}>
        </div>
        <div class="form-group">
            <label for="comment">Product Details</label>
            <textarea class="form-control" id="comment" rows="5" name="product_details">

            </textarea>
        </div>
        <div class="form-group">
            <label for="squareInput">Ingredients</label>
            <input type="text" name="product_details" class="form-control input-square" id="squareInput" placeholder="Square Input">
        </div>
        <div class="form-group">
            <label for="squareInput">Expiry Date</label>
            <input type="date" name="expiry_date" class="form-control input-square" id="squareInput" placeholder="Square Input">
        </div>
        <div class="form-group">
            <label for="squareInput">Brand Name</label>
            <input type="text" name="brand_name" class="form-control input-square" id="squareInput" placeholder="Square Input">
        </div>
        <div class="form-group">
            <label for="squareSelect">Sub Category</label>
            <select class="form-control input-square" id="squareSelect" name="sub_category_id">
                <option value="">Select Sub Category</option>
                @foreach ($subCategories as $subCategory)
                    <option value="{{ $subCategory->id }}" {{ $subCategory->id == old('sub_category_id', $product->sub_category_id ?? '') ? 'selected' : '' }}>
                        {{ $subCategory->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
@endsection