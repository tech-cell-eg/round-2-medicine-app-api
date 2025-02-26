@extends('layouts.main')

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="card-title">Edit Product</div>
        </div>
        <div class="card-body">
            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="squareInput">Name</label>
                    <input type="text" name="name" class="form-control input-square" id="squareInput"
                        value="{{ $product->name }}">
                </div>

                <div class="form-group">
                    <label for="comment">Description</label>
                    <textarea class="form-control" id="comment" rows="5" name="description">{{ $product->description }}</textarea>
                </div>

                <div class="form-group">
                    <label for="squareInput">Price</label>
                    <input type="text" name="price" class="form-control input-square" value="{{ $product->price }}">
                </div>

                <div class="form-group">
                    <label for="comment">Product Details</label>
                    <textarea class="form-control" rows="5" name="product_details">{{ $product->product_details }}</textarea>
                </div>

                <div class="form-group">
                    <label for="squareInput">Ingredients</label>
                    <input type="text" name="ingredients" class="form-control input-square"
                        value="{{ $product->ingredients }}">
                </div>

                <div class="form-group">
                    <label for="squareInput">Expiry Date</label>
                    <input type="date" name="expiry_date" class="form-control input-square"
                        value="{{ $product->expiry_date }}">
                </div>

                <div class="form-group">
                    <label for="squareInput">Brand Name</label>
                    <input type="text" name="brand_name" class="form-control input-square"
                        value="{{ $product->brand_name }}">
                </div>

                <div class="form-group">
                    <label for="squareSelect">Sub Category</label>
                    <select class="form-control input-square" name="sub_category_id">
                        <option value="">Select Sub Category</option>
                        @foreach ($subCategories as $subCategory)
                            <option value="{{ $subCategory->id }}"
                                {{ $subCategory->id == old('sub_category_id', $product->sub_category_id ?? '') ? 'selected' : '' }}>
                                {{ $subCategory->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                
                <div class="form-group">
                    <label for="image">Product Image</label>
                    <input type="file" name="image" class="form-control">
                    @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" width="100" class="mt-2">
                    @endif
                </div>

            
                <div class="form-group">
                    <label>Product Sizes</label>
                    <div id="sizes-container">
                        @foreach ($product->sizes as $size)
                            <div class="size-group d-flex mb-2">
                                <input type="text" name="sizes[][size]" class="form-control mr-2" placeholder="Size"
                                    value="{{ $size['size'] }}">
                                <input type="number" name="sizes[][price]" class="form-control" placeholder="Price"
                                    value="{{ $size['price'] }}">
                                <button type="button" class="btn btn-danger remove-size ml-2">X</button>
                            </div>
                        @endforeach
                    </div>
                    <button type="button" class="btn btn-primary mt-2" id="add-size">Add Size</button>
                </div>

                <button type="submit" class="btn btn-success mt-3">Update Product</button>
            </form>
        </div>
    </div>

    <!-- JavaScript for Dynamic Sizes -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('add-size').addEventListener('click', function() {
                let sizeContainer = document.getElementById('sizes-container');
                let newSize = document.createElement('div');
                newSize.classList.add('size-group', 'd-flex', 'mb-2');
                newSize.innerHTML = `
                <input type="text" name="sizes[][size]" class="form-control mr-2" placeholder="Size">
                <input type="number" name="sizes[][price]" class="form-control" placeholder="Price">
                <button type="button" class="btn btn-danger remove-size ml-2">X</button>
            `;
                sizeContainer.appendChild(newSize);
            });

            document.getElementById('sizes-container').addEventListener('click', function(event) {
                if (event.target.classList.contains('remove-size')) {
                    event.target.parentElement.remove();
                }
            });
        });
    </script>
@endsection
