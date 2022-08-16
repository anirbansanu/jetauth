<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    //
    public function index()
    {
        return Cart::all();
    }
    public function store()
    {
        
    }
    public function show($id)
    {
        return Cart::find($id);
    }
    public function destroy($id)
    {
        return Cart::destroy($id);
    }
}
