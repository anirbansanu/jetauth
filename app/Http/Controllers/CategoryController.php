<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class CategoryController extends Controller
{
    //
    function getAll()
    {
        $data = Category::all();
        return view("admin.categories",['data'=>$data]);
    }
    function setCategory(Request $request)
    {
        $data = new Category;
        $data->cat_title = $request->cat_title;
        if ($data->save())
        return response()->json(['data' => $request->cat_title,'id'=> $data->id], 201); 
        else
        return redirect()->back()->with('error', 'Add Category Operation Failed');

    }
    function deleteCategory($id){
        $data = Category::find($id);
        
        return $data->delete();
    }
}
