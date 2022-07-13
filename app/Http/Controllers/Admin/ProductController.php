<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index()
    {
        $product=Product::all();
        return view('admin.product.index',compact('product'));
    }

    public function create()
    {
        $category=Category::all();
        return view('admin.product.create',compact('category'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'cate_id'=>'required',
            'name' => 'required',
            'slug' => 'required',
            'smalldescription'=>'required',
            'description' => 'required',
            'originalprice'=>'required',
            'sellingprice'=>'required',
            'tax'=>'required',
            'quantity'=>'required',
            'meta_title' => 'required',
            'meta_description' => 'required',
            'meta_keywords' => 'required'
        ]);

        $product=new Product();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('assets/uploads/product', $filename);
            $product->image = $filename;
        }
        $product->cate_id = $request->cate_id;
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->small_description = $request->smalldescription;
        $product->description = $request->description;
        $product->original_price = $request->originalprice;
        $product->selling_price = $request->sellingprice;
        $product->qty = $request->quantity;
        $product->tax = $request->tax;
        $product->status = $request->status == TRUE ? '1' : '0';
        $product->trending = $request->trending == TRUE ? '1' : '0';
        $product->meta_title = $request->meta_title;
        $product->meta_description = $request->meta_description;
        $product->meta_keywords = $request->meta_keywords;
        $product->save();
        return redirect('/products')->with('message', "Product Successfull Added!!");

    }

    public function edit($id)
    {
        $product=Product::find($id);
        $category=Category::all();
        return view('admin.product.edit',compact('product','category'));
    }

    public function update(Request $request,$id)
    {
        $product=Product::find($id);
        if ($request->hasFile('image')) {
            $path = 'assets/uploads/product/' . $product->image;
            if (File::exists($path)) {
                File::delete($path);
            }
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('assets/uploads/product', $filename);
            $product->image = $filename;
        }
        $request->validate([
            'name' => 'required',
            'slug' => 'required',
            'smalldescription'=>'required',
            'description' => 'required',
            'originalprice'=>'required',
            'sellingprice'=>'required',
            'tax'=>'required',
            'quantity'=>'required',
            'meta_title' => 'required',
            'meta_description' => 'required',
            'meta_keywords' => 'required'
        ]);
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->small_description = $request->smalldescription;
        $product->description = $request->description;
        $product->original_price = $request->originalprice;
        $product->selling_price = $request->sellingprice;
        $product->qty = $request->quantity;
        $product->tax = $request->tax;
        $product->status = $request->status == TRUE ? '1' : '0';
        $product->trending = $request->trending == TRUE ? '1' : '0';
        $product->meta_title = $request->meta_title;
        $product->meta_description = $request->meta_description;
        $product->meta_keywords = $request->meta_keywords;
        $product->update();
        return redirect('/products')->with('message',"Product Updated Successfully!!");

    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if ($product->image) {
            $path = 'assets/uploads/product/' . $product->image;
            if (File::exists($path)) {
                File::delete($path);
            }
        }
        $product->delete();
        return redirect('/products')->with('message',"Product Delete Successful!!");
    }
}
