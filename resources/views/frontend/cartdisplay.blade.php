@extends('layouts.front')
@section('title')
My Cart
@endsection
@section('content')

<div class="container my-5">
    <div class="card shadow mycart">
        @if($cartitems->count()>0)
        <div class="card-body">
            @php $total=0; @endphp
            @foreach($cartitems as $rows)
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
                <div class="col-md-3">
                    <input type="hidden" class="prod_id" value="{{$rows->product_id}}">
                    @if($rows->product->qty>$rows->qty)
                    <label for="">Quantity</label>
                    <div class="input-group text-center mb-3" style="width: 130px;">
                        <button class="input-group-text changequantity minus">-</button>
                        <input type="text" name="quantity" value="{{$rows->qty}}" class="form-control text-center quantity">
                        <button class="input-group-text changequantity plus">+</button>
                    </div>
                    @php $total += $rows->product->selling_price * $rows->qty; @endphp
                    @else
                    <h6>Out Of Stock</h6>
                    @endif
                </div>
                <div class="col-md 2">

                    <button class="btn btn-danger delete-cart-item">Remove</button>
                </div>
            </div>
            @endforeach
        </div>
        <div class="card-footer">
            <h6>Total Price: {{$total}}</h6>
            <a href="/checkout" class="btn btn-outline-success float-end">CheckOut</a>
        </div>
        @else
        <div class="card-body text-center">
            <h2>Your Cart is Empyt</h2>
            <a href="/category" class="btn btn-outline-primary float-end">Continue Shopping</a>
        </div>
        @endif
    </div>
</div>

@endsection