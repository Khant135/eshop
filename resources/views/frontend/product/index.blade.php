@extends('layouts.front')
@section('title')
    Products
@endsection
@section('content')

<div class="py-5">
    <div class="container">
        <div class="row">
            <h2>{{$category->name}}</h2>
            @foreach($product as $rows)
            <div class="col-md-3 mt-3">
                <a href="/productdetail/{{$rows->slug}}">
                    <div class="card">
                        <img height="180px" src="{{asset('assets/uploads/product/'.$rows->image)}}" alt="">
                        <div class="card-body">
                            <h5>{{$rows->name}}</h5>
                            <span class="float-start">{{$rows->selling_price}}</span>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection