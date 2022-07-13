<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function orderlist()
    {
        $orders=Order::where('status','0')->get();
        return view('admin.order.index',compact('orders'));
    }

    public function orderlist_show($id)
    {
        $order=Order::where('id',$id)->where('status','0')->first();
        return view('admin.order.orderdetail',compact('order'));
    }

    public function orderlistupdate(Request $request,$id)
    {
        $order=Order::find($id);
        $order->status=$request->orderstatus;
        $order->update();
        return redirect('/orderlists')->with('message',"Successfully Updated!!");
    }

    public function orderlist_history()
    {
        $orders=Order::where('status','1')->get();
        return view('admin.order.orderhistory',compact('orders'));
    }

    public function userlist()
    {
        $users=User::all();
        // $users=User::where('role_as','0')->get();
        return view('admin.user.index',compact('users'));
    }

    public function userlist_show($id)
    {
        //$user=User::find($id);
        $user=User::where('id',$id)->first();
        return view('admin.user.userdetail',compact('user'));
    }
}
