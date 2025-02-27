@extends('layouts.main')

@section('content')
    <div class="container mt-5">
        <div class="card shadow-sm p-4">
            <h3 class="text-center">{{ $product->name }}</h3>

            {{-- صورة المنتج --}}
            @if ($product->image)
                <div class="text-center my-3">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid rounded"
                        style="max-width: 300px;">
                </div>
            @endif

            {{-- الوصف --}}
            <div class="mt-4 p-3 border rounded">
                <h4>Description</h4>
                <p class="text-muted">{{ $product->description }}</p>
            </div>

            {{-- التفاصيل --}}
            <div class="mt-4 p-3 border rounded">
                <h4>Product Details</h4>
                <p class="text-muted">{{ $product->product_details }}</p>
            </div>

            {{-- المكونات --}}
            <div class="mt-4 p-3 border rounded">
                <h4>Ingredients</h4>
                <p class="text-muted">{{ $product->ingredients }}</p>
            </div>

            {{-- السعر --}}
            <div class="mt-4 p-3 border rounded">
                <h4>Price</h4>
                @if ($product->old_price)
                    <p class="text-danger text-decoration-line-through">{{ $product->old_price }} LE</p>
                @endif
                <p class="text-success fw-bold h5">{{ $product->price }} LE</p>
            </div>

            {{-- المقاسات --}}
            @if (!empty($product->sizes))
                @php
                    $sizes = is_array($product->sizes) ? $product->sizes : json_decode($product->sizes, true);
                @endphp

                @if (is_array($sizes) && count($sizes) > 0)
                    <div class="mt-4 p-3 border rounded">
                        <h4>Available Sizes</h4>
                        <ul class="list-group">
                            @foreach ($sizes as $size)
                                @if (is_array($size) && isset($size['size'], $size['price']))
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>{{ $size['size'] }}</span>
                                        <span class="badge bg-primary p-2">{{ $size['price'] }} EGP</span>
                                    </li>
                                @else
                                    <li class="list-group-item text-danger">Invalid size data</li> {{-- ❌ عرض رسالة في حالة وجود بيانات غير صالحة --}}
                                @endif
                            @endforeach
                        </ul>
                    </div>
                @else
                    <p class="text-muted">No sizes available.</p>
                @endif
            @endif





            {{-- اسم العلامة التجارية --}}
            <div class="mt-4 p-3 border rounded">
                <h4>Brand Name</h4>
                <span class="h6">{{ $product->brand_name }}</span>
            </div>

            {{-- التقييمات --}}
            <div class="mt-4 p-3 border rounded">
                <h4>Rating</h4>
                <p class="h5">
                    {{ $product->rating }} <i class="la la-star text-warning"></i>
                    <small class="text-muted">({{ $product->rating_count }} ratings)</small>
                </p>
            </div>

            {{-- عدد التقييمات --}}
            <div class="mt-4 p-3 border rounded">
                <h4>Reviews</h4>
                <p class="h6">{{ $product->review_count }} Reviews</p>
            </div>
        </div>
    </div>
@endsection
