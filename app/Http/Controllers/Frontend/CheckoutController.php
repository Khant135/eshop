<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $old_cartitems=Cart::where('user_id',Auth::id())->get();
        foreach($old_cartitems as $items)
        {
            if(!Product::where('id',$items->product_id)->where('qty','>=',$items->qty)->exists())
            {
                $removeItem=Cart::where('user_id',Auth::id())->where('product_id',$items->product_id)->first();
                $removeItem->delete();
            }
        }
        $cartitems=Cart::where('user_id',Auth::id())->get();
        return view('frontend.checkout',compact('cartitems'));
    }

    public function store(Request $request)
    {
        $total=0;

        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required',
            'phonenumber' => 'required',
            'address1' => 'required',
            'city' => 'required',
            'state' => 'required',
            'country' => 'required',
            'pincode' => 'required'
        ]);

        $order=new Order();
        $order->fname=$request->fname;
        $order->lname=$request->lname;
        $order->email=$request->email;
        $order->phone=$request->phonenumber;
        $order->address1=$request->address1;
        $order->address2=$request->address2;
        $order->city=$request->city;
        $order->state=$request->state;
        $order->country=$request->country;
        $order->pincode=$request->pincode;
        $order->user_id=Auth::id();
        $order->totalprice=0;
        $order->tracking_number='sharma'.rand(1111,9999);
        $order->save();

        $order_id=  $order->id;
        $cartitems=Cart::where('user_id',Auth::id())->get();
        foreach($cartitems as $item)
        {
            OrderItem::create([
                'order_id'=>$order_id,
                'product_id'=>$item->product_id,
                'quantity'=>$item->qty,
                'price'=>$item->product->selling_price,
            ]);
            
            $total += $item->product->selling_price * $item->qty;

            $prod=Product::where('id',$item->product_id)->first();
            $prod->qty=$prod->qty-$item->qty;
            $prod->update();
        }
        
        $order1=Order::where('id',$order_id)->first();
        $order1->totalprice=$total;
        $order1->update();

        if(Auth::user()->address1 == NULL)
        {
            $user=User::where('id',Auth::id())->first();
            $user->name=$request->fname;
            $user->lname=$request->lname;
            $user->phone=$request->phonenumber;
            $user->address1=$request->address1;
            $user->address2=$request->address2;
            $user->city=$request->city;
            $user->state=$request->state;
            $user->country=$request->country;
            $user->pincode=$request->pincode;
            $user->update();
        }

        $cartitems=Cart::where('user_id',Auth::id())->get();
        Cart::destroy($cartitems);

        return redirect('/')->with('message',"Ordering Process Successful!!");
    }
}
