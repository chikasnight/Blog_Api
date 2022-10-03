<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    
    public function post(Request $request){
        //validate request body
        $request->validate([
            'posts'=>['required'],
            
        ]);
        //create a blog post
        $newBlogPost = Post::create([
            'user_id'=>1,
            'posts'=> $request->posts,
           
            
        ]);
        
        //return cuccess response

        return response()->json([
            'success'=> true,
            'message'=>'successfully created a post',
            'data' => new PostResource($newBlogPost),
        ]);
    }
    public function updatePost(Request $request, $postId){
        $request->validate([
            'posts'=>['required'],

        ]);
        
        $post = Post::find($postId);
        if(!$post) {
            return response() ->json([
                'success' => false,
                'message' => 'Post not found'
            ]);

        $this->authorize('update',$post);

        }

        $post->posts = $request->posts;
        $post->save();
        return response() ->json([
            'success' => true,
            'message' => 'Post updated'
        ]);
    }
    public function deletePost( $postId){

        $post = Post::find($postId);
        if(!$post) {
            return response() ->json([
                'success' => false,
                'message' => 'post not found'
            ]);
        }

        
        $this->authorize('delete',$post);

        //delete property
        $post-> delete();

        return response() ->json([
            'success' => true,
            'message' => 'post deleted'
            ]); 
    }
}
