<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::all();
        return CommentResource::collection($comments);
    }

    
    public function show($id)
    {
        $comment = Comment::findOrFail($id);
        return new CommentResource($comment);
    }

    public function store(Request $request)
    {

    $user_id = Auth::user()->id; 

    $validator = Validator::make($request->all(), [
        'text' => 'required',
        'post_id' => 'required',

    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors());
    }

        //MODERATOR
        $isModerator = Auth::user()->isModerator;
        //ADMIN
        $isAdmin = Auth::user()->isAdmin;
    
        if ($isModerator || $isAdmin) {
            return response()->json(['error' => 'Unauthorized: Administrator or moderator cant create any comments!!!'], 403);
        }


    $comment = new Comment();
    $comment->text = $request->text;
    $comment->dateOfCreation = Carbon::now()->format('Y-m-d');
    $comment->numberOfLikes = 0;
    $comment->numberOfDislikes = 0;
    $comment->user_id = $user_id;
    $comment->post_id = $request->post_id;

    $comment->save();

    return response()->json(['The user has successfuly created a comment!!!',
         new CommentResource($comment)]);
    }

    public function update(Request $request, $id)
    {
        $user_id = Auth::user()->id; 
        $comment_user_id = Comment::where('id', $id)->value('user_id');

        $validator = Validator::make($request->all(), [
            'text' => 'required',
            'post_id' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json($errors);
        }
    //MODERATOR
    $isModerator = Auth::user()->isModerator;
    //ADMIN
    $isAdmin = Auth::user()->isAdmin;

    if ($isModerator || $isAdmin) {
        return response()->json(['error' => 'Unauthorized: Administrator or moderator cant alter any comments!!!'], 403);
    }

        $comment = Comment::findOrFail($id);

        $comment->text = $request->text;
        $comment->dateOfCreation = Carbon::now()->format('Y-m-d');
        $comment->numberOfLikes = 0;
        $comment->numberOfDislikes = 0;
        $comment->user_id = $comment_user_id;
        $comment->post_id = $request->post_id;

        $comment->save();

        return response()->json(['The specific comment is successfuly altered!', new CommentResource($comment)]);
    }


    public function updateText(Request $request, $id)
     {

         $request->validate([
             'text' => 'required'
         ]);

         //MODERATOR
         $isModerator = Auth::user()->isModerator;

         if (!$isModerator) {
             return response()->json(['error' => 'Unauthorized: This is the function that can only be done by an administrator or by the user that created this comment!!!'], 403);
         }

         $comment = Comment::findOrFail($id);

         $comment->update(['text' => $request->input('text')]);

         return response()->json(['message' => 'Comment text successfully altered.', new CommentResource($comment)]);
     }



    public function destroy($id)
    {
         //MODERATOR
         $isModerator = Auth::user()->isModerator;

         if (!$isModerator) {
             return response()->json(['error' => 'Unauthorized: This is the function that can only be done by an administrator or by the user that created this comment!!!'], 403);
         }

        $comment = Comment::findOrFail($id);
        $comment->delete();
        return response()->json('You have successfuly deleted a comment!');
    }
}
