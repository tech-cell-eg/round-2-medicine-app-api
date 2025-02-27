@extends('layouts.main')

@section('content')
<div class="container mt-4">
    <h2>Add New Product</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="col-md-3 mb-3">
                <label for="price" class="form-label">Price ($)</label>
                <input type="number" name="price" id="price" class="form-control" step="0.01" required>
            </div>
            <div class="col-md-3 mb-3">
                <label for="old_price" class="form-label">Old Price ($)</label>
                <input type="number" name="old_price" id="old_price" class="form-control" step="0.01">
            </div>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" rows="3"></textarea>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="product_details" class="form-label">Product Details</label>
                <textarea name="product_details" id="product_details" class="form-control" rows="2"></textarea>
            </div>
            <div class="col-md-6 mb-3">
                <label for="ingredients" class="form-label">Ingredients</label>
                <textarea name="ingredients" id="ingredients" class="form-control" rows="2"></textarea>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="expiry_date" class="form-label">Expiry Date</label>
                <input type="date" name="expiry_date" id="expiry_date" class="form-control">
            </div>
            <div class="col-md-4 mb-3">
                <label for="brand_name" class="form-label">Brand Name</label>
                <input type="text" name="brand_name" id="brand_name" class="form-control">
            </div>
            <div class="col-md-4 mb-3">
                <label for="rating" class="form-label">Rating</label>
                <input type="number" name="rating" id="rating" class="form-control" step="0.1" min="0" max="5" value="0">
            </div>
        </div>

        <div class="mb-3">
            <label for="sub_category_id" class="form-label">Sub Category</label>
            <select name="sub_category_id" id="sub_category_id" class="form-select" required>
                <option value="" disabled selected>Select a sub category</option>
                @foreach ($subCategories as $subCategory)
                    <option value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label>Product Sizes</label>
            <div id="sizes-container"></div>
            <button type="button" class="btn btn-primary mt-2" id="add-size">Add Size</button>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Product Image</label>
            <input type="file" name="image" id="image" class="form-control" accept="image/*">
            <div class="mt-2">
                <img id="imagePreview" src="#" alt="Product Image Preview" class="img-thumbnail" style="max-width: 200px; display: none;">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Create Product</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let sizeIndex = 0;
        document.getElementById('add-size').addEventListener('click', function() {
            let sizeContainer = document.getElementById('sizes-container');
            let newSize = document.createElement('div');
            newSize.classList.add('size-group', 'd-flex', 'mb-2');
            newSize.innerHTML = `
                <input type="text" name="sizes[${sizeIndex}][size]" class="form-control mr-2" placeholder="Size">
                <input type="number" name="sizes[${sizeIndex}][price]" class="form-control" placeholder="Price">
                <button type="button" class="btn btn-danger remove-size ml-2">X</button>
            `;
            sizeContainer.appendChild(newSize);
            sizeIndex++;
        });

        document.getElementById('sizes-container').addEventListener('click', function(event) {
            if (event.target.classList.contains('remove-size')) {
                event.target.parentElement.remove();
            }
        });

        let imageInput = document.getElementById("image");
        let imagePreview = document.getElementById("imagePreview");
        imageInput.addEventListener("change", function(event) {
            let file = event.target.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = "block";
                };
                reader.readAsDataURL(file);
            } else {
                imagePreview.style.display = "none";
            }
        });
    });
</script>
@endsection
