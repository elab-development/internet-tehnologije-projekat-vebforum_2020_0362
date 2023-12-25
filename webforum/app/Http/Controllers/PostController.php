<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return PostResource::collection($posts);
    }

    
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return new PostResource($post);
    }

    public function store(Request $request)
    {

    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'text' => 'required',
        'user_id' => 'required',
        'thread_id' => 'required',

    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors());
    }


    $post = new Post();
    $post->name = $request->name;
    $post->text = $request->text;
    $post->dateOfCreation = Carbon::now()->format('Y-m-d');
    $post->numberOfLikes = 0;
    $post->numberOfDislikes = 0;
    $post->user_id = $request->user_id;
    $post->thread_id = $request->thread_id;

    $post->save();

    return response()->json(['The user has successfuly created a post on the topic of: '.$post->name.'!!!',
         new PostResource($post)]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'text' => 'required',
            'user_id' => 'required',
            'thread_id' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json($errors);
        }

        $post = Post::findOrFail($id);

        $post->name = $request->name;
        $post->text = $request->text;
        $post->dateOfCreation = Carbon::now()->format('Y-m-d');
        $post->numberOfLikes = 0;
        $post->numberOfDislikes = 0;
        $post->user_id = $request->user_id;
        $post->thread_id = $request->thread_id;

        $post->save();

        return response()->json(['The specific post is successfuly altered!', new PostResource($post)]);
    }


    public function updateStatus(Request $request, $id)
     {
         $request->validate([
             'status' => 'required'
         ]);

         $post = Post::findOrFail($id);

         $post->update(['status' => $request->input('status')]);

         return response()->json(['message' => 'Post status successfully altered.', new PostResource($post)]);
     }



    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return response()->json('You have successfuly deleted a post!');
    }
}
