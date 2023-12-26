<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ThreadResource;
use App\Models\Thread;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Auth;

class ThreadController extends Controller
{
    public function index()
    {
        $threads = Thread::all();
        return ThreadResource::collection($threads);
    }

    
    public function show($id)
    {
        $thread = Thread::findOrFail($id);
        return new ThreadResource($thread);
    }

    public function store(Request $request)
    {
    $user_id = Auth::user()->id; 

    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'description' => 'required',

    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors());
    }

        //MODERATOR
        $isModerator = Auth::user()->isModerator;
        //ADMIN
        $isAdmin = Auth::user()->isAdmin;
    
        if ($isModerator || $isAdmin) {
            return response()->json(['error' => 'Unauthorized: Administrator or moderator cant create a thread!!!'], 403);
        }


    $thread = new Thread();
    $thread->name = $request->name;
    $thread->description = $request->description;
    $thread->dateOfCreation = Carbon::now()->format('Y-m-d');
    $thread->user_id = $user_id;

    $thread->save();

    return response()->json(['The user has successfuly created a thread on the topic of: '.$thread->name.'!!!',
         new ThreadResource($thread)]);
    }

    public function update(Request $request, $id)
    {
        //ADMIN
        $isAdmin = Auth::user()->isAdmin;

        if (!$isAdmin) {
            return response()->json(['error' => 'Unauthorized: This is the function that can only be done by an administrator or by the user who created this thread!!!'], 403);
        }


        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json($errors);
        }

        $thread = Thread::findOrFail($id);
        $user_id = Auth::user()->id; 
        $thread_user_id = Thread::where('id', $id)->value('user_id');

        $thread->name = $request->name;
        $thread->description = $request->description;
        $thread->dateOfCreation = Carbon::now()->format('Y-m-d');
        $thread->user_id = $thread_user_id;

        $thread->save();

        return response()->json(['The specific thread is successfuly altered!', new ThreadResource($thread)]);
    }


    public function destroy($id)
    {
        //ADMIN
        $isAdmin = Auth::user()->isAdmin;

        if (!$isAdmin) {
            return response()->json(['error' => 'Unauthorized: This is the function that can only be done by an administrator or by the user who created this thread!!!'], 403);
        }

        $thread = Thread::findOrFail($id);
        $thread->delete();
        return response()->json('You have successfuly deleted a thread!');
    }
}
