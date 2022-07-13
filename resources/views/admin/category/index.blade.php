@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-body">
        <div class="card-header">
            <h4>Category Page</h4>
            <hr>
        </div>
        <div class="card-body">
            <!-- @if(session()->has('message'))
            <p style="color:red;">{{session('message')}}</p>
            @endif -->
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($category as $rows)
                    <tr>
                        <td>{{$rows->id}}</td>
                        <td>{{$rows->name}}</td>
                        <td>{{$rows->description}}</td>
                        <td><img src="{{asset('assets/uploads/category/'.$rows->image)}}" class="card-image" alt=""></td>
                        <td>
                            <a href="/categories/{{$rows->id}}/edit" class="btn btn-primary">Edit</a>
                            <form action="/categories/{{$rows->id}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection