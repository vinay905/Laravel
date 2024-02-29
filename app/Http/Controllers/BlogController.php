<?php

namespace App\Http\Controllers;
use App\Models\blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function storeblogdata(Request $request){
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
          ]);
          
        $file_name =$request->file('image')->getClientOriginalName();
        request()->image->move(public_path('images'), $file_name);
        $data =([
            "title"=> $request->title,
            "description"=> $request->content,
            "image"=> $file_name]) ;
        $blog = blog::create($data);    
        if($blog){
            echo "success, now redirect to another page";
        }
    }
}
