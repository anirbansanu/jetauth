<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    function getProducts(){
        $result = (new ProductController)->getProducts();
        return view('user.home',['products'=>$result]);
    }
}
