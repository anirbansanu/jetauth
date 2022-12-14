<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    //
    function getProducts()
    {
        $data = Product::all();
        //return $data;
        return view('admin.products',["data"=>$data]);
    }
    function setProducts(Request $request)
    {
        $data = new Product;
        $data->title = $request->title;
        $data->price = $request->price;
        $data->quantity = $request->quantity;
        $data->description = $request->description;
        $cat = Category::find($request->category_id);
        if(!$cat)
        return redirect()->back()->with('error', 'Category Not Exists, Operation Failed');
        if($request->hasFile("file"))
        {
            $d_path = "public/product_imgs/";
            $image = $request->file("file");
            $imageName = date('YmdHi').$image->getClientOriginalName();
            $path = $request->file("file")->storeAs($d_path,$imageName);
            if($path)
            {
                $data->image = $imageName;
                $cat->product()->save($data);
            }
            else
            {
                return redirect()->back()->with('error', 'Image Upload Failed, Add Operation Failed');
            }
        }
        
        
        return redirect()->back()->with('success', 'Data has been saved');
    }
    function getAllUsers(){
        $usersdata = User::all();
        return view('admin.users',["usersdata"=>$usersdata]);
    }
    function changeUserType(Request $request){
        $data = User::find($request->userid);
        if ($request->usertype)
            $data->usertype = 1;
        else
            $data->usertype = 0;
        if ($data->update())
        return response()->json(['data' => 'Operation Usertype Changed','usertype'=> $data->usertype], 201); 
        else
        return response()->json(['data' => 'Operation Failed','usertype'=> $data->usertype], 201); 
    }
    function updateProduct(Request $request)
    {
        $data = Product::find($request->id);
        $data->title = $request->title;
        $data->price = $request->price;
        $data->quantity = $request->quantity;
        $data->description = $request->description;
        $cat = Category::find($request->category_id);
        if(!$cat)
        return redirect()->back()->with('error', 'Category Not Exists, Operation Failed');
        if($request->hasFile("file"))
        {
            $d_path = "public/product_imgs/";
            $image = $request->file("file");
            $imageName = date('YmdHi').$image->getClientOriginalName();
            $path = $request->file("file")->storeAs($d_path,$imageName);
            if($path)
            {
                $data->image = $imageName;
                $cat->product()->update($data);
            }
            else
            {
                return redirect()->back()->with('error', 'Image Upload Failed, Add Operation Failed');
            }
        }
        return redirect()->back()->with('success', 'Data has been saved');

    }
    function viewProduct($id){
        $product = Product::findOrFail($id);
        $data = Category::all();
        //return [$product,$data];
        return view('admin.updateproduct',["product"=>$product,"data"=>$data]);
    }
    function deleteProduct($id){
        $product = Product::find($id);
        if(Storage::exists('public/product_imgs/'.$product->image)){
            if ($product->delete() && Storage::delete('public/product_imgs/'.$product->image))
            return response()->json(['success' => 'Data Deleted','title'=> $product->title], 201);
            else
            return response()->json(['error' => 'Delete Operation Failed',]);
            
        }else{
            return response()->json(['error' => 'Product Image not exist Operation Failed',]);
        }
        
    }
    function getOrders(){
        $o = Order::all();
        //return $o;
        return view('admin.orders',["data"=>$o]);
    }
}
