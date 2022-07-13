@extends('layouts.front')
@section('title')
{{$product->name}}
@endsection
@section('content')

<div class="py-3 mb-4 shadow-sm bg-warning border-top">
    <div class="container">
        <h6 class="mb-0">{{$product->name}}</h6>
    </div>
</div>

<div class="container">
    <div class="card shadow product_data">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4 border-right">
                    <img src="{{asset('assets/uploads/product/'.$product->image)}}" class="w-100" alt="">
                </div>
                <div class="col-md-8">
                    <h2 class="mb-0">
                        {{$product->name}}
                        @if($product->trending=='1')
                        <label for="" style="font-size: 16px;" class="float-end badge bg-danger trending_tag">Trending</label>
                        @endif
                    </h2>
                    <hr>
                    <label for="" class="me-3">Original Price: ${{$product->selling_price}}</label>
                    <p class="mt-3">
                        {!!$product->small_description!!}
                    </p>
                    <hr>
                    @if($product->qty>0)
                    <label for="" class="badge bg-success">In Stock</label>
                    @else
                    <label for="" class="badge bg-danger">Out of Stock</label>
                    @endif
                    <div class="row mt-2">
                        <div class="col-md-3">
                            <input type="hidden" class="productid" value="{{$product->id}}">
                            <label for="">Quantity</label>
                            <div class="input-group text-center mb-3">
                                <button class="input-group-text minus">-</button>
                                <input type="text" name="quantity" value="1" class="form-control text-center quantity">
                                <button class="input-group-text plus">+</button>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <br>
                            @if($product->qty>0)
                            <button type="button" class="btn btn-success me-3 float-start addtocart">Add to Cart</button>
                            @endif
                            <button type="button" class="btn btn-success me-3 float-start addtowishlist">Add to Wishlist</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection