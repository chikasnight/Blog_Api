<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function posts(Request $request){
        //validate request body
        $request->validate([
            'posts'=>['required'],
            'comments'=>['required']
        ]);
        //create a blog post
        $newBlogPost = Blog::create([
            'user_id'=>1,
            'posts'=> $request->posts,
            'comments'=> $request->comments
            
        ]);
        
        //return cuccess response

        return response()->json([
            'success'=> true,
            'message'=>'successfully created a post',
            'data' => new BlogResource($newBlogPost),
        ]);
    }
}
