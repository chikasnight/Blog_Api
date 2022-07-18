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
            'post_id'=>auth()->id(),
            'comments'=> $request->comments
            
        ]);
        
        //return cuccess response

        return response()->json([
            'success'=> true,
            'message'=>'successfully created a comment',
            'data' => new CommentResource($newBlogComment),
        ]);
    }
    public function updateComment(Request $request, $commentId){
        $request->validate([
            'comments'=>['required'],

        ]);
        
        $comment = Comment::find($commentId);
        if(!$commentId) {
            return response() ->json([
                'success' => false,
                'message' => 'comment not found'
            ]);

        $this->authorize('update',$comment);

        }

        $comment->comments = $request->comments;
        $comment->save();
        return response() ->json([
            'success' => true,
            'message' => 'comment updated'
        ]);
    }
    public function deleteComment( $commentId){

        $comment = Comment::find($commentId);
        if(!$comment) {
            return response() ->json([
                'success' => false,
                'message' => 'comment not found'
            ]);
        }

        

        $this->authorize('delete',$comment);
        //delete property
        $comment-> delete();

        return response() ->json([
            'success' => true,
            'message' => 'comment deleted'
            ]); 
    }
}
