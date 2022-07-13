<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlists=Wishlist::where('user_id',Auth::id())->get();
        return view('frontend.wishlist',compact('wishlists'));
    }
    
    public function store(Request $request)
    {
        $product_id=$request->product_id;
        if (Auth::check()) 
        {
            $check=Product::find($product_id);
            if ($check) {
                if (Wishlist::where('product_id',$product_id)->where('user_id',Auth::id())->exists()) {

                    return response()->json(['status'=> $check->name." Already Added!!"]);
                }
                else 
                {
                    $wish=new Wishlist();
                    $wish->product_id=$product_id;
                    $wish->user_id=Auth::id();
                    $wish->save();
                    return response()->json(['status'=> $check->name." Successfully Added!!"]);
                }
                
            }
        }
        else
        {
            return response()->json(['status'=> " Login to Continue!!"]);
        }
    }

    public function whishdelete(Request $request)
    {
        if (Auth::check()) {
            $product_id=$request->product_id;
            $user_id=Auth::id();
            if (Wishlist::where('product_id',$product_id)->where('user_id',$user_id)->exists()) {
                $wishlistitem=Wishlist::where('product_id',$product_id)->where('user_id',$user_id)->first();
                $wishlistitem->delete();
                return response()->json(['status'=> " Remove Process Successful!!"]);
            }
        }
        else
        {
            return response()->json(['status'=> " Login to Continue!!"]);
        }
    }

    public function wishlistcount()
    {
        $wishlistcount=Wishlist::where('user_id',Auth::id())->count();
        return response()->json(['count'=>$wishlistcount]);
    }
}
