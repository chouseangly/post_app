<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Comment\CommentController;
use App\Http\Controllers\Post\PostController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/posts', [PostController::class, 'store']); //
    Route::get('/posts', [PostController::class, 'getAllPost']);
    //we post with image or work with img u can't use put or patch for updating , used post instead of it
    Route::post('/posts/{id}',[PostController::class,'updatePost']);

    Route::delete('/posts/{id}',[PostController::class,'deletePost']);

    // comment route
    Route::post('/comments',[CommentController::class,'addComment']);
});


Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
