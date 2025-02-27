@extends('layouts.main')

@section('content')



    <div class="card">
        <div class="card-header">
            <div class="card-title">Products List</div>
        </div>
        <div class="d-flex justify-content-between align-items-center mb-3 m-3">
            <a href="{{route('products.create')}}" class="btn btn-success">
                <i class="fas fa-plus"></i> Add Product
            </a>
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
                @foreach ($products as $product)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }} EGP</td>
                    <td>{{ $product->subCategory->name ?? 'No SubCategory' }}</td>
                    <td>{{ $product->subCategory->category->name ?? 'No Category' }}</td>
                    <td>
                        <a href="{{route('products.show', ['id'=>$product->id]) }}" class="btn btn-primary btn-sm">View</a>
                        <a href="{{route('products.edit' , ['id'=>$product->id]) }}" class="btn btn-warning btn-sm">Edit</a>
                        <button class="btn btn-danger btn-sm delete-product" data-id="{{ $product->id }}">Delete</button>
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).on('click', '.delete-product', function() {
        let productId = $(this).data('id');
        let url = "{{ route('products.destroy', ':id') }}".replace(':id', productId);

        if (confirm("Are you sure you want to delete this product?")) {
            $.ajax({
                url: url,
                type: 'DELETE',
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    alert(response.message);
                    location.reload();
                },
                error: function(xhr) {
                    alert('Error deleting product. Please try again.');
                }
            });
        }
    });
</script>

@endsection
