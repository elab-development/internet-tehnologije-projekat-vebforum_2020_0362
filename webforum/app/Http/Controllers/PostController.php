<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

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
    $user_id = Auth::user()->id;    

    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'text' => 'required',
        'thread_id' => 'required',

    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors());
    }

    //MODERATOR
    $isModerator = Auth::user()->isModerator;
    //ADMIN
    $isAdmin = Auth::user()->isAdmin;

    if ($isModerator || $isAdmin) {
        return response()->json(['error' => 'Unauthorized: Administrator or moderator cant create a post!!!'], 403);
    }


    $post = new Post();
    $post->name = $request->name;
    $post->text = $request->text;
    $post->dateOfCreation = Carbon::now()->format('Y-m-d');
    $post->numberOfLikes = 0;
    $post->numberOfDislikes = 0;
    $post->user_id = $user_id;
    $post->thread_id = $request->thread_id;
    $post->status = 'Posted';

    $post->save();

    return response()->json(['The user has successfuly created a post on the topic of: '.$post->name.'!!!',
         new PostResource($post)]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'text' => 'required',
            'thread_id' => 'required',
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
                return response()->json(['error' => 'Unauthorized: Administrator or moderator cant alter a post!!!'], 403);
            }

        $post = Post::findOrFail($id);
        $user_id = Auth::user()->id; 
        $post_user_id = Post::where('id', $id)->value('user_id');

        $post->name = $request->name;
        $post->text = $request->text;
        $post->dateOfCreation = Carbon::now()->format('Y-m-d');
        $post->numberOfLikes = 0;
        $post->numberOfDislikes = 0;
        $post->user_id = $post_user_id;
        $post->thread_id = $request->thread_id;
        $post->status = 'Posted';

        $post->save();

        return response()->json(['The specific post is successfuly altered!', new PostResource($post)]);
    }


    public function updateStatus(Request $request, $id)
     {
         $request->validate([
             'status' => 'required'
         ]);

         //MODERATOR
         $isModerator = Auth::user()->isModerator;

         if (!$isModerator) {
             return response()->json(['error' => 'Unauthorized: This is the function that can only be done by an administrator or by the user that created this comment!!!'], 403);
         }

         $post = Post::findOrFail($id);

         $post->update(['status' => $request->input('status')]);

         return response()->json(['message' => 'Post status successfully altered.', new PostResource($post)]);
     }



    public function destroy($id)
    {
        //MODERATOR
        $isModerator = Auth::user()->isModerator;

        if (!$isModerator) {
            return response()->json(['error' => 'Unauthorized: This is the function that can only be done by an administrator or by the user that created this post!!!'], 403);
        }
        $post = Post::findOrFail($id);
        $post->delete();
        return response()->json('You have successfuly deleted a post!');
    }
}
