<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Frontend\WishlistController;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/',function (){
//     return view('frontend.index');
// });
Route::get('/',[FrontendController::class,'index']);
Route::get('/category',[FrontendController::class,'category']);
Route::get('/viewcategory/{slug}',[FrontendController::class,'viewcategory']);
Route::get('/productdetail/{slug}',[FrontendController::class,'productdetail']);
Route::post('/cart_create',[CartController::class,'cartcreate']);
Route::post('/cartitemdelete',[CartController::class,'itemdelete']);
Route::post('/updatequantity',[CartController::class,'updatequantity']);
Route::post('/cart_wishlist',[WishlistController::class,'store']);
Route::post('//withlistdelete',[WishlistController::class,'whishdelete']);
Route::get('/load-cart-data',[CartController::class,'cartcount']);
Route::get('/load-wishlist-data',[WishlistController::class,'wishlistcount']);
Route::get('/searchproduct',[FrontendController::class,'searchproduct']);
Route::post('/performsearch',[FrontendController::class,'performsearch']);


Route::middleware('auth')->group(function(){
    Route::get('/cartdisplay',[CartController::class,'cartdisplay']);
    Route::get('/checkout',[CheckoutController::class,'index']);
    Route::post('/checkout/store',[CheckoutController::class,'store']);
    Route::get('/my-orders',[UserController::class,'index']);
    Route::get('/my-orders/{order}',[UserController::class,'show']);
    Route::get('wishlist',[WishlistController::class,'index']);
    
});

Route::middleware(['auth','isAdmin'])->group(function(){
    Route::get('/dashboard', function () {
        return view('admin.index');
     }); 
     //Route::get('/categories','Admin\CategoryController@index'); <- you can also connect route like this

     Route::get('/categories',[CategoryController::class,'index'])->name('categories');
     Route::get('/categories/create',[CategoryController::class,'create']);
     Route::post('/categories',[CategoryController::class,'store']);
     Route::get('/categories/{category}/edit',[CategoryController::class,'edit']);
     Route::put('/categories/{category}',[CategoryController::class,'update']);
     Route::delete('/categories/{category}',[CategoryController::class,'destroy']);

     Route::get('/products',[ProductController::class,'index']);
     Route::get('/products/create',[ProductController::class,'create']);
     Route::post('/products',[ProductController::class,'store']);
     Route::get('/products/{product}/edit',[ProductController::class,'edit']);
     Route::put('/products/{product}',[ProductController::class,'update']);
     Route::delete('/products/{product}',[ProductController::class,'destroy']);

     Route::get('/orderlists',[AdminController::class,'orderlist']);
     Route::get('/admin/orderlist/{orderlist}',[AdminController::class,'orderlist_show']);
     Route::put('orderlists/{orderlist}',[AdminController::class,'orderlistupdate']);
     Route::get('/orderlists/history',[AdminController::class,'orderlist_history']);
     Route::get('/users',[AdminController::class,'userlist']);
     Route::get('/admin/userlist/{userlist}',[AdminController::class,'userlist_show']);
 });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

 
