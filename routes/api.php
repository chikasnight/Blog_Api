<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::group(['middleware' => 'auth:sanctum'], function () {

    Route::post('logout', [AuthController::class, 'logout']);

    Route::delete('account/delete', [AuthController::class, 'accountDelete']);
    Route::post('change/password', [AuthController::class, 'changePassword']);

    Route::post('posts', [PostController::class, 'post']);
    Route::put('posts/{postId}', [PostController::class, 'updatePost']);
    Route::delete('posts/{postId}', [PostController::class, 'deletePost']);

    Route::post('comments', [CommentController::class, 'comment']);
    Route::put('comments/{commentId}', [CommentController::class, 'updateComment']);
    Route::delete('comments/{commentId}', [CommentController::class, 'deleteComment']);
});
