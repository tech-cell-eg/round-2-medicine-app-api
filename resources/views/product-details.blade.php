@extends('layouts.main')

@section('content')
<div class="card">
    <tr>
        <td><span class="h3">{{$product->name}}</span></td>
    </tr>
    <tr>
    <td><blockquote>
        <h4>description</h4>
        <p class="blockquote blockquote-primary">
            {{$product->description}}
            <br>
            <br>
            <small>
                - Noaa
            </small>
        </p>
    </blockquote></td>
    </tr>
    <tr>
        <td>
            <p>Price :</p>

        </td>
        <td><p class="text-warning">{{$product->price}} LE</p></span></td>
    </tr>
    <tr>
        <td><blockquote>
            <h4>Product Details</h4>
            <p class="blockquote blockquote-primary">
                {{$product->product_details}}
                <br>
                <br>
                <small>
                    - Noaa
                </small>
            </p>
        </blockquote></td>
        </tr>
        <tr>
            <td>
                <p>Expiry Date</p>

            </td>
            <td><p class="text-danger">{{$product->expiry_date}}</p></span></td>
        </tr>
        <tr>
            <td>
                <p>Brand Name </p>

            </td>
            <td><span class="h6">{{$product->brand_name}}</span></td>
        </tr>
        <tr>
            <td>
                <p>Rating</p>

            </td>
            <td><span class="h6">{{$product->rating}} <i class="la la-star" style="color: yellow;"></i> </span></td>
        </tr>
</div>
@endsection