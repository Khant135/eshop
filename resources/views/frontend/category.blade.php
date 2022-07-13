@extends('layouts.front')
@section('title')
    Category
@endsection
@section('content')

<div class="py-5">
    <div class="container">
        <div class="row">
            <h2>Feature Category</h2>
            @foreach($trendingcategory as $rows1)
            <div class="col-md-3 mt-3">
                <a href="/viewcategory/{{$rows1->slug}}">
                    <div class="card">
                        <img height="180px" src="{{asset('assets/uploads/category/'.$rows1->image)}}" alt="">
                        <div class="card-body">
                            <h5>{{$rows1->name}}</h5>
                            <p>{{$rows1->description}}</p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection