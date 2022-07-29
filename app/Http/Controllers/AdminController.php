<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    function getProducts()
    {
        $data = Product::join('categories', 'products.category_id', '=', 'categories.id',"left outer")
                            ->select('products.*','categories.cat_title')
                            ->get();
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
    
}
