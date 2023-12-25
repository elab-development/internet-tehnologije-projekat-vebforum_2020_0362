<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

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

    $validator = Validator::make($request->all(), [
        'text' => 'required',
        'user_id' => 'required',
        'post_id' => 'required',

    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors());
    }


    $comment = new Comment();
    $comment->text = $request->text;
    $comment->dateOfCreation = Carbon::now()->format('Y-m-d');
    $comment->numberOfLikes = 0;
    $comment->numberOfDislikes = 0;
    $comment->user_id = $request->user_id;
    $comment->post_id = $request->post_id;

    $comment->save();

    return response()->json(['The user has successfuly created a comment!!!',
         new CommentResource($comment)]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'text' => 'required',
            'user_id' => 'required',
            'post_id' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json($errors);
        }

        $comment = Comment::findOrFail($id);

        $comment->text = $request->text;
        $comment->dateOfCreation = Carbon::now()->format('Y-m-d');
        $comment->numberOfLikes = 0;
        $comment->numberOfDislikes = 0;
        $comment->user_id = $request->user_id;
        $comment->post_id = $request->post_id;

        $comment->save();

        return response()->json(['The specific comment is successfuly altered!', new CommentResource($comment)]);
    }


    public function updateText(Request $request, $id)
     {
         $request->validate([
             'text' => 'required'
         ]);

         $comment = Comment::findOrFail($id);

         $comment->update(['text' => $request->input('text')]);

         return response()->json(['message' => 'Comment text successfully altered.', new CommentResource($comment)]);
     }



    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        return response()->json('You have successfuly deleted a comment!');
    }
}
