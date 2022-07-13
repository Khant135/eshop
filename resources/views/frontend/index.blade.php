@extends('layouts.front')
@section('title')
Welcome to E-Shop
@endsection
@section('content')
@include('layouts.inc.slider')

<div class="py-5">
    <div class="container">
        <div class="row">
            <h2>Feature Products</h2>
            @foreach($trendingproduct as $rows)
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
            <h2 class="mt-3">Trending Category</h2>
            @foreach($trendingcategory as $rows1)
            <div class="col-md-3 mt-3">
                <a href="/viewcategory/{{$rows1->slug}}">
                    <div class="card">
                        <img height="180px" src="{{asset('assets/uploads/category/'.$rows1->image)}}" alt="">
                        <div class="card-body">
                            <h5>{{$rows1->name}}</h5>
                            <!-- <span class="float-start">{{$rows1->selling_price}}</span> -->
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection