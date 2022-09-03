<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        return redirect('/');
        else
        {
            $result = (new ProductController)->getProducts();
            return view('user.home',['products'=>$result]);
        }
    }
    function addCart(Request $request){
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
    function getCart(){
        $u_id = auth()->user()?auth()->user()->id:false;
        if($u_id)
        {
            $carts = Cart::join('products', 'carts.product_id', '=', 'products.id')
                            ->join('users', 'carts.user_id', '=', 'users.id')
                            ->select('products.*','users.name','users.address','users.phone','carts.*')
                            ->where('carts.user_id','=',$u_id)
                            ->get();
            //return $carts;
            return view("user.cart",['carts'=>$carts]);
        }
        else
        {
            return redirect()->back()->with('error', 'Carts Not Exists, Operation Failed');
        }
    }
    function updateCart(Request $request){
        $u_id = auth()->user()?auth()->user()->id:false;
        if($u_id)
        {
            $c = Cart::find($request->cart_id);
            $actual_price = ($c->order_price / $c->order_quantity);
            $actual_price = $actual_price * $request->order_quantity;
            $c->order_price = $actual_price;
            $c->order_quantity = $request->order_quantity;
            
            if($c->update())
            return response()->json(['success' => 'Operation Usertype Changed','quantity'=> $c->order_quantity,'cart_id'=>$c->cart_id], 201); 
            else
            return response()->json(['error' => 'Operation Usertype Changed','order_quantity'=> $request->order_quantity,'cart_id'=>$request->cart_id], 201); 

        }
        
    }
    function deleteCart(Request $request){
        $u_id = auth()->user()?auth()->user()->id:false;
        if($u_id)
        {
            $c = Cart::find($request->cart_id);
            $c->delete();
        }
    }
    function setOrder(Request $req){
        $u_id = auth()->user()?auth()->user()->id:false;
        if($u_id)
        {
            $c = Cart::where("user_id","=",$u_id)->get();
            $data=[];
            if($c)
            {
                for($i=0;$i<count($c);$i++)
                {
                    
                    $data[$i]['product_id'] = $c[$i]->product_id;
                    $data[$i]['order_quantity'] = $c[$i]->order_quantity;
                    $data[$i]['order_price'] = $c[$i]->order_price;
                    $data[$i]['user_id'] = $c[$i]->user_id;
                    if(Order::create($data[$i]))
                    Cart::where('user_id',$u_id)->delete();

                }
                
                return redirect()->route('user.order');
            }
            else
            return redirect()->back();
        }
        return redirect('login');
    }
    function getOrder(){
        $u_id = auth()->user()?auth()->user()->id:false;
        if($u_id)
        {
            $o = Order::join('products', 'orders.product_id', '=', 'products.id')
                            ->join('users', 'orders.user_id', '=', 'users.id')
                            ->select('products.*','users.name','users.address','users.phone','orders.*')
                            ->where('orders.user_id','=',$u_id)
                            ->get();
            //return $carts;
            return view("user.order",['orders'=>$o]);
        }
        return redirect('login');
    }
}
