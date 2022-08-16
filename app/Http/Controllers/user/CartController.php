<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{
    //
    public function store(Request $request)
    {
        if(Auth::id())
        {
            $data = new Cart;

            $product = Product::find($request->product_id);
            if(!$product)
            return redirect()->back()->with('error', 'Product Not Exists, Operation Failed');
            $user_id = auth()->user()->id;
            $user = User::find($user_id);
            if(!$user)
            return redirect()->back()->with('error', 'User Not Exists, Operation Failed');
            $data->user()->associate($user);
            $data->product()->associate($product);
            $data->order_price = $product->price;
            $data->save();

            //return $data;
            return redirect('cart')->with('success', 'Product Added To the Cart');
        }
        else
        {
            return redirect()->route('login');
        }
       
    }
    public function show($id)
    {
        return Cart::find($id);
    }
    public function destroy($id)
    {
        //return Cart::find($id);
        if(Cart::destroy($id))
        return Redirect::back()->with('success','Cart item deleted successfully');
        else
        return Redirect::back()->with('error','Delete Operation Failed');
    }
}
