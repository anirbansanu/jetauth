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
    // public function index()
    // {
    //     $u_id = auth()->user()?auth()->user()->id:false;
    //     if($u_id)
    //     {
    //         $carts = Cart::join('products', 'carts.product_id', '=', 'products.id')
    //                         ->join('users', 'carts.user_id', '=', 'users.id')
    //                         ->select('products.*','users.name','users.address','users.phone','carts.*')
    //                         ->where('carts.user_id','=',$u_id)
    //                         ->get();
    //         //return $carts;
    //         return view("user.cart",['carts'=>$carts]);
    //     }
    //     else
    //     {
    //         return redirect()->back()->with('error', 'Carts Not Exists, Operation Failed');
    //     }
    // }
    // public function index()
    // {
    //     $user = User::with('cart')->with(['cart'=>function($query){
    //         $query->orderBy('created_at', 'DESC');
    //       }])
    //       ->where('id',$u_id = auth()->user()?auth()->user()->id:false)->get();
        
    //     //return view("user.cart",['carts'=>$user]);
    //     return $user;
    // }
    public function index(){
        $user = User::with('recentItemCart')
        ->where('id',$u_id = auth()->user()?auth()->user()->id:false)->get();
        return $user;
    }
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
            //return redirect('cart')->with('success', 'Product Added To the Cart');
            return response()->json(['data' => 'Product Added To the Cart'], 201); 
        }
        else
        {
            return response()->json(['data' => 'Failed To Add Product In Cart'], 201); 
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
