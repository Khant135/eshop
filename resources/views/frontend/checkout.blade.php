@extends('layouts.front')
@section('title')
Check Out
@endsection
@section('content')

<div class="container mt-3">
    <form action="/checkout/store" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <h6>Basic Details</h6>
                        <hr>
                        <div class="row check-form">
                            <div class="col-md-6">
                                <label for="">First Name</label>
                                <input type="text" name="fname" value="{{Auth::user()->name}}" class="form-control" placeholder="Enter First Name">
                                @error('fname')
                                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="">Last Name</label>
                                <input type="text" name="lname" value="{{Auth::user()->lname}}" class="form-control" placeholder="Enter Last Name">
                                @error('lname')
                                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="">Email</label>
                                <input type="email" name="email" value="{{Auth::user()->email}}" class="form-control" placeholder="Enter Email">
                                @error('email')
                                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="">Phone Number</label>
                                <input type="text" name="phonenumber" value="{{Auth::user()->phone}}" class="form-control" placeholder="Enter Phone Number">
                                @error('phonenumber')
                                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="">Address 1</label>
                                <input type="text" name="address1" class="form-control" value="{{Auth::user()->address1}}" placeholder="Enter Address 1">
                                @error('address1')
                                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="">Address 2</label>
                                <input type="text" name="address2" value="{{Auth::user()->address2}}" class="form-control" placeholder="Enter Address 2">
                            </div>
                            <div class="col-md-6">
                                <label for="">City</label>
                                <input type="text" name="city" value="{{Auth::user()->city}}" class="form-control" placeholder="Enter City">
                                @error('city')
                                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="">State</label>
                                <input type="text" name="state" value="{{Auth::user()->state}}" class="form-control" placeholder="Enter State">
                                @error('state')
                                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="">Country</label>
                                <input type="text" name="country" value="{{Auth::user()->country}}" class="form-control" placeholder="Enter Country">
                                @error('country')
                                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="">Pin Code</label>
                                <input type="text" name="pincode" value="{{Auth::user()->pincode}}" class="form-control" placeholder="Enter Pin Code">
                                @error('pincode')
                                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <h6>Order Details</h6>
                        <hr>
                        <table class="table table-striped table-bordered">
                            <tbody>
                                <tr>
                                    <td>Name</td>
                                    <td>Quantity</td>
                                    <td>Price</td>
                                </tr>
                                @foreach ($cartitems as $items)
                                <tr>
                                    <td>{{$items->product->name}}</td>
                                    <td>{{$items->qty}}</td>
                                    <td>{{$items->product->selling_price}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <hr>
                        <button type="submit" class="btn btn-primary float-end">Place Order</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection