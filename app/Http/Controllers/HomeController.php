<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //
    function redirect(){
        $utype = Auth::user()->usertype;
        if($utype)
        return view('admin.home');
        else
        {
            $result = (new ProductController)->getProducts();
            return view('user.home',['products'=>$result]);
        }
        
    

    }
    function index(){
        $uid = Auth::id();
        if($uid)
        return redirect('redirect');
        else
        {
            $result = (new ProductController)->getProducts();
            return view('user.home',['products'=>$result]);
        }
    }
}
