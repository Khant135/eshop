@extends('layouts.front')
@section('title')
My WishList
@endsection
@section('content')

<div class="container my-5">
    <div class="card shadow mywishlist">
        <div class="card-body">
            @if($wishlists->count()>0)
            @foreach($wishlists as $rows)
            <div class="row product_data">
                <div class="col-md-2">
                    <img src="{{asset('assets/uploads/product/'.$rows->product->image)}}" height="70px" width="70px" alt="">
                </div>
                <div class="col-md-3">
                    <h6>{{$rows->product->name}}</h6>
                </div>
                <div class="col-md-2">
                    <h6>{{$rows->product->selling_price}}</h6>
                </div>
                <div class="col-md-2">
                    <input type="hidden" class="productid" value="{{$rows->product_id}}">
                    @if($rows->product->qty>=$rows->qty)
                    <label for="">Quantity</label>
                    <div class="input-group text-center mb-3" style="width: 130px;">
                        <button class="input-group-text minus">-</button>
                        <input type="text" name="quantity" value="1" class="form-control text-center quantity">
                        <button class="input-group-text plus">+</button>
                    </div>
                    @else
                    <h6>Out Of Stock</h6>
                    @endif
                </div>
                <div class="col-md 2">
                    <button class="btn btn-success addtocart">Add to Cart</button>
                </div>
                <div class="col-md 2">
                    <button class="btn btn-danger removewishlist">Remove</button>
                </div>
            </div>
            @endforeach
            @else
            <h4>There are no products in Your WishList!!</h4>
            @endif
        </div>
    </div>
</div>

@endsection