<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
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

Route::get("/users",[AdminController::class,'getAllUsers'])->name('admin.users');
Route::post("/usertype",[AdminController::class,'changeUserType'])->name('admin.usertype');


Route::post("/categories",[CategoryController::class,'setCategory'])->name('admin.addcategory');
Route::get("/categories",[CategoryController::class,'getAll'])->name('admin.categories');
Route::get("/delete_categories/{id?}",[CategoryController::class,'deleteCategory'])->name('admin.deletecategory');


Route::get("/product/{id?}",[ProductController::class,'getProduct'])->name('user.product');

Route::get("/products",[AdminController::class,'getProducts'])->name('admin.products');
Route::get("/updateproduct/{id?}",[AdminController::class,'viewProduct'])->name('admin.updateproduct');
Route::post("/updateproduct",[AdminController::class,'updateProduct'])->name('admin.updateproduct');

Route::get("/deleteproduct/{id?}",[AdminController::class,'deleteProduct'])->name('admin.deleteproduct');


Route::get("/allproducts",[ProductController::class,'getAllProducts'])->name('user.allproducts');

Route::get("/addproduct",[ProductController::class,'getCategories'])->name('admin.addproduct');

Route::post("/setproduct",[AdminController::class,'setProducts'])->name('admin.setproduct');

Route::post("/cart",[HomeController::class,'addCart'])->name('user.cart');
Route::get("/cart",[HomeController::class,'getCart'])->name('user.cart');
Route::post("/updatecart",[HomeController::class,'updateCart'])->name('user.updatecart');


