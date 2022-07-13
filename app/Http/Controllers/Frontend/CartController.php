<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function cartcreate(Request $request)
    {
        $product_id=$request->product_id;
        $quantity=$request->quantity;
        if (Auth::check()) 
        {
            $check=Product::where('id',$product_id)->first();
            if ($check) {
                if (Cart::where('product_id',$product_id)->where('user_id',Auth::id())->exists()) {

                    return response()->json(['status'=> $check->name." Already Added!!"]);
                }
                else 
                {
                    $cartitem=new Cart();
                    $cartitem->product_id=$product_id;
                    $cartitem->user_id=Auth::id();
                    $cartitem->qty=$quantity;
                    $cartitem->save();
                    return response()->json(['status'=> $check->name." Successfully Added!!"]);
                }
                
            }
        }
        else
        {
            return response()->json(['status'=> " Login to Continue!!"]);
        }
    }

    public function cartdisplay()
    {
        $cartitems=Cart::where('user_id',Auth::id())->get();
        return view('frontend.cartdisplay',compact('cartitems'));
    }

    public function itemdelete(Request $request)
    {
        if (Auth::check()) {
            $product_id=$request->product_id;
            $user_id=Auth::id();
            if (Cart::where('product_id',$product_id)->where('user_id',$user_id)->exists()) {
                $cartitem=Cart::where('product_id',$product_id)->where('user_id',$user_id)->first();
                $cartitem->delete();
                return response()->json(['status'=> " Remove Process Successful!!"]);
            }
        }
        else
        {
            return response()->json(['status'=> " Login to Continue!!"]);
        }
        
    }

    public function updatequantity(Request $request)
    {
        $product_id=$request->product_id;
        $quantity=$request->quantity;
        
        if (Auth::check()) {
            $user_id=Auth::id();
            if (Cart::where('product_id',$product_id)->where('user_id',$user_id)->exists()) {
                $cart=Cart::where('product_id',$product_id)->where('user_id',$user_id)->first();
                $cart->qty=$quantity;
                $cart->update();
                return response()->json(['status'=>"Quantity Updated!!"]);
            }
        }
    }

    public function cartcount()
    {
        $cartcount=Cart::where('user_id',Auth::id())->count();
        return response()->json(['count'=>$cartcount]);
    }

}
