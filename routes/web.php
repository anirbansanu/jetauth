<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\user\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\user\OrderController;
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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
Route::get("/redirect",[HomeController::class,'redirect'])->name('admin.home');
Route::get("/",[HomeController::class,'index']);
Route::group(['middleware'=>['auth','user']],function(){ 
    //Route::get("/redirect",[HomeController::class,'redirect'])->name('user.home');
    Route::get("/product/{id?}",[ProductController::class,'getProduct'])->name('user.product');
    Route::get("/allproducts",[ProductController::class,'getAllProducts'])->name('user.allproducts');
    Route::post("/cart",[CartController::class,'store'])->name('user.cart');
    Route::get("/cart",[CartController::class,'index'])->name('user.cart');
    Route::get("/cart/delete/{id}",[CartController::class,'destroy'])->name('user.cart.destroy');
    Route::post("/updatecart",[HomeController::class,'updateCart'])->name('user.updatecart');
    Route::post("/order",[HomeController::class,'setOrder'])->name('user.order');
    Route::get("/order",[OrderController::class,'getOrder'])->name('user.order');
    Route::post("/payment",[OrderController::class,'payment'])->name('user.payment');

});
Route::group(['middleware'=>['auth','admin']],function(){
    //Route::get("/redirect",[HomeController::class,'redirect'])->name('admin.home');
    Route::get("/users",[AdminController::class,'getAllUsers'])->name('admin.users');
    Route::post("/usertype",[AdminController::class,'changeUserType'])->name('admin.usertype');
    Route::post("/categories",[CategoryController::class,'setCategory'])->name('admin.addcategory');
    Route::get("/categories",[CategoryController::class,'getAll'])->name('admin.categories');
    Route::get("/delete_categories/{id?}",[CategoryController::class,'deleteCategory'])->name('admin.deletecategory');
    Route::get("/products",[AdminController::class,'getProducts'])->name('admin.products');
    Route::get("/updateproduct/{id?}",[AdminController::class,'viewProduct'])->name('admin.updateproduct');
    Route::post("/updateproduct",[AdminController::class,'updateProduct'])->name('admin.updateproduct');
    Route::get("/deleteproduct/{id?}",[AdminController::class,'deleteProduct'])->name('admin.deleteproduct');
    Route::get("/addproduct",[ProductController::class,'getCategories'])->name('admin.addproduct');
    Route::post("/setproduct",[AdminController::class,'setProducts'])->name('admin.setproduct');
    Route::get("/orders",[AdminController::class,'getOrders'])->name('admin.orders');

});

