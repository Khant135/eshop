<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $orders=Order::where('user_id',Auth::id())->get();
        return view('frontend.order.index',compact('orders'));
    }

    public function show($id)
    {
        $order=Order::where('id',$id)->where('user_id',Auth::id())->first();
        return view('frontend.order.detail',compact('order'));
    }
}
