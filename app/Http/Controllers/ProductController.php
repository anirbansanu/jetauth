<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    function getCategories(){
        $result = Category::all();
        return view("admin.addproduct",['data'=>$result]);
    }
    function getProducts()
    {
        $data = Product::paginate(6);
        return $data;
    }
    function getAllProducts()
    {
        $products = Product::paginate(6);
              
        // return $products;
        return view("user.allproducts",['products'=>$products]);
    }
    function getProduct($id){
        $product = Product::join('categories', 'products.category_id', '=', 'categories.id',"left outer")
        ->select('products.*','categories.cat_title')
        ->where('products.id','=',$id)
        ->first();
        //return $product;
        return view('user.productdetails',["product"=>$product]);
    }
}
