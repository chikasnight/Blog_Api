<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;



Route::post('register',[BlogController::class,'register']);
Route::post('login',[BlogController::class,'login']);
Route::delete('logout',[BlogController::class,'logout']);

Route::post('create/posts', [BlogController::class, 'posts']);
Route::post('post/comments', [BlogController::class, 'comments']);
Route::post('change/password', [BlogController::class, 'changePassword']);
Route::delete('account/delete', [BlogController::class, 'accountDelete']);
