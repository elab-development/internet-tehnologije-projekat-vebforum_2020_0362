<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\SearchController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


//login i registracija
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

//Reset lozinke
Route::post('resetPassword',[AuthController::class,'resetPassword']);

//USERS
Route::get('users', [UserController::class, 'index']);
Route::get('users/{id}', [UserController::class, 'show']); 
 
//POSTS
Route::get('posts', [PostController::class, 'index']);
Route::get('posts/{id}', [PostController::class, 'show']); 

//COMMENTS
Route::get('comments', [CommentController::class, 'index']);
Route::get('comments/{id}', [CommentController::class, 'show']); 

//RUTE ZA KOJE NAM TREBA LOGIN
Route::group(['middleware' => ['auth:sanctum']], function () {

    //USERS
    Route::delete('users/{id}', [UserController::class, 'destroy']); //ADMIN
    
    //THREADS
    Route::resource('threads', ThreadController::class);

    //pretraga Thread po imenu
    Route::get('/search/threads', [SearchController::class, 'searchThread']);

    //POSTS
    Route::post('posts', [PostController::class, 'store']);
    Route::put('posts/{id}', [PostController::class, 'update']); 
    Route::patch('posts/alterTheStatus/{id}', [PostController::class, 'updateStatus']);
    Route::delete('posts/{id}', [PostController::class, 'destroy']);

    //COMMENTS
    Route::post('comments', [CommentController::class, 'store']);
    Route::put('comments/{id}', [CommentController::class, 'update']); 
    Route::patch('comments/alterText/{id}', [CommentController::class, 'updateText']);
    Route::delete('comments/{id}', [CommentController::class, 'destroy']);

    //LOGOUT
    Route::post('logout', [AuthController::class, 'logout']);

});

