@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h4 class="text-white">Order Lists
                        <a href="/orderlists/history" class="btn btn-warning float-right">Order History</a>
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Tracking Number</th>
                                <th>Total Price</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $rows)
                            <tr>
                                <td>{{$rows->tracking_number}}</td>
                                <td>{{$rows->totalprice}}</td>
                                <td>{{$rows->status=='0'?'Pending':'Complete'}}</td>
                                <td>
                                    <a href="admin/orderlist/{{$rows->id}}" class="btn btn-primary">View</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection