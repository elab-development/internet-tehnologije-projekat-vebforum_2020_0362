<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //registracija
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['Registration failed:', $validator->errors()]);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $token = $user->createToken('TokenReg')->plainTextToken;

        $odgovor = [
            'Poruka' => 'Successful registration!',
            'User: ' => $user,
            'Token: ' => $token,
        ];

        return response()->json($odgovor);
    }

    //login
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['Greska:', $validator->errors()]);
        }

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json(['Greska pri logiovanju: ' => 'Login failed, try again!']);
        }

        $user = User::where('email', $request['email'])->firstOrFail();



        $token = $user->createToken('TokenLogin')->plainTextToken;

        $odgovor = [
            'Poruka' => 'Successful login!',
            'User: ' => $user,
            'Token: ' => $token,
        ];


        return response()->json($odgovor);
    }

    //logout
    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response()->json('Successful logout!.');
    }


    //RESETOVANJE PASSWORDA
    public function resetPassword(Request $request)
    {   
        $request->validate([
            'email' => 'required',
            'new_password' => 'required|string|min:8'
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            $user->password = Hash::make($request->new_password);
            $user->save();

            return response()->json(['poruka' => 'Successfuly reseted your password.']);
        }

        return response()->json(['poruka' => 'The user with that email doesent exist.'], 404);
    }
}
