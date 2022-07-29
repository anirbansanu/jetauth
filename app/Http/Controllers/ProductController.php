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
        $data = Product::join('categories', 'products.category_id', '=', 'categories.id',"left outer")
                              ->select('products.*','categories.cat_title')
                              ->get();
        return $data;
    }
}
