<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\UserResource;
use App\Models\User;

use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return UserResource::collection($users);
    }

    
    public function show($id)
    {
        $user = User::findOrFail($id);
        return new UserResource($user);
    }

    public function destroy($id)
    {
        //ADMIN
        $isAdmin = Auth::user()->isAdmin;

        if (!$isAdmin) {
            return response()->json(['error' => 'Unauthorized: This is the function that can only be done by an administrator!!!'], 403);
        }

        $user = User::findOrFail($id);
        $user->delete();
        return response()->json('You have successfuly deleted a user!');
    }
}
