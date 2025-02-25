@extends('layouts.main')

@section('content')
<div class="card">
    <div class="card-header">
        <div class="card-title">Products List</div>
    </div>
    <div class="card-body">
        <table class="table table-head-bg-success">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Sub Category</th>
                    <th>Main Category</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }} EGP</td>
                    <td>{{ $product->subCategory->name ?? 'No SubCategory' }}</td>
                    <td>{{ $product->subCategory->category->name ?? 'No Category' }}</td>
                    <td>
                        <a href="{{route('products.show', ['id'=>$product->id]) }}" class="btn btn-primary btn-sm">View</a>
                        <a href="{{route('products.edit' , ['id'=>$product->id]) }}" class="btn btn-warning btn-sm">Edit</a>
                        <a href="#" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $products->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>
@endsection
