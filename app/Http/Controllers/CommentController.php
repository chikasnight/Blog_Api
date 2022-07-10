<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Resources\CommentResource;

class CommentController extends Controller
{
    
    public function comment(Request $request){
        //validate request body
        $request->validate([
            'comments'=>['required']
        ]);
        //create a blog post
        $newBlogComment = Comment::create([
            'user_id'=>auth()->id(),
            'comments'=> $request->comments
            
        ]);
        
        //return cuccess response

        return response()->json([
            'success'=> true,
            'message'=>'successfully created a post',
            'data' => new CommentResource($newBlogComment),
        ]);
    }
    public function updateComment(Request $request, $commentId){
        $request->validate([
            'comments'=>['required'],

        ]);
        
        $comment = Post::find($commentId);
        if(!$postId) {
            return response() ->json([
                'success' => false,
                'message' => 'comment not found'
            ]);

        $this->authorize('update',$commentId);

        }

        $comment->comments = $request->comments;
        $comment->save();
    }
    public function deleteComment( $commentId){

        $comment = Post::find($commentId);
        if(!$comment) {
            return response() ->json([
                'success' => false,
                'message' => 'comment not found'
            ]);
        }

        


        //delete property
        $comment-> delete();

        return response() ->json([
            'success' => true,
            'message' => 'commentId deleted'
            ]); 
    }
}
