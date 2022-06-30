<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Authentication;


Route::group(['middleware' =>'auth:sanctum'],function(){
   
    Route::post('logout/user/{userId}',[Authentication::class,'logout']);
    Route::post('create/posts', [BlogController::class, 'posts']);
    Route::post('post/comments', [BlogController::class, 'comments']);
    Route::delete('account/delete', [Authentication::class, 'accountDelete']);
    Route::post('change/password', [Authentication::class, 'changePassword']);
});
Route::post('login/user',[Authentication::class,'login']);
Route::post('register/user',[Authentication::class,'register']);
