<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\ThreadResource;
use App\Models\Thread;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

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

    $validator = Validator::make($request->all(), [
        'name' => 'required',
        'description' => 'required',
        'user_id' => 'required',

    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors());
    }


    $thread = new Thread();
    $thread->name = $request->name;
    $thread->description = $request->description;
    $thread->dateOfCreation = Carbon::now()->format('Y-m-d');
    $thread->user_id = $request->user_id;

    $thread->save();

    return response()->json(['The user has successfuly created a thread on the topic of: '.$thread->name.'!!!',
         new ThreadResource($thread)]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'description' => 'required',
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json($errors);
        }

        $thread = Thread::findOrFail($id);

        $thread->name = $request->name;
        $thread->description = $request->description;
        $thread->dateOfCreation = Carbon::now()->format('Y-m-d');
        $thread->user_id = $request->user_id;

        $thread->save();

        return response()->json(['The specific thread is successfuly altered!', new ThreadResource($thread)]);
    }


    public function updateDescription(Request $request, $id)
     {
         $request->validate([
             'description' => 'required'
         ]);

         $thread = Thread::findOrFail($id);

         $thread->update(['description' => $request->input('description')]);

         return response()->json(['message' => 'Thread description successfully altered.', new ThreadResource($thread)]);
     }



    public function destroy($id)
    {
        $thread = Thread::findOrFail($id);
        $thread->delete();
        return response()->json('You have successfuly deleted a thread!');
    }
}
