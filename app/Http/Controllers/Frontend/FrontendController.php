<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $trendingproduct=Product::where('trending','1')->take(4)->get();
        $trendingcategory=Category::where('popular','1')->take(4)->get();
        return view('frontend.index',compact('trendingproduct','trendingcategory'));
    }

    public function category()
    {
        $trendingcategory=Category::where('status','1')->take(4)->get();
        return view('frontend.category',compact('trendingcategory'));
    }

    public function viewcategory($slug)
    {
        if (Category::where('slug',$slug)->exists()) {
            $category=Category::where('slug',$slug)->first();
            $product=Product::where('cate_id',$category->id)->where('status','1')->get();
            return view('frontend.product.index',compact('product','category'));
        }
        else {
            return redirect('/')->with('message',"Invalid");
        }
    }

    public function productdetail($slug)
    {
        if (Product::where('slug',$slug)->exists()) {
            $product=Product::where('slug',$slug)->first();
            return view('frontend.product.productdetail',compact('product'));
        }
        else {
            return redirect('/')->with('message',"Invalid");
        }
    }

    public function searchproduct()
    {
        $products=Product::select('name')->where('status','1')->get();
        $data=[];
        foreach ($products as $rows)
        {
            $data[] =$rows['name'];
        }
        return $data;
    }

    public function performsearch(Request $request)
    {
        $searchproduct=$request->search;
        if ($searchproduct!="") {
            $product=Product::where('name',"LIKE","%$searchproduct%")->first();
            if ($product) {
                return redirect('/productdetail/'.$product->slug);
            }
            else
            {
                return redirect()->back()->with('message',"No Record Found!!");
            }
        } else {
            return redirect()->back();
        }
        
    }
}
