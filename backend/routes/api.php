<?php

use App\Http\Controllers\TodoController;
use App\Http\Middleware\JsonPrintMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*auth*/
Route::post('register', [AuthController::class, 'register']);
Route::post("login",[AuthController::class,'login']);

Route::group(['middleware' => 'auth:sanctum'], function(){
    /*create*/
    Route::post('create-todo', [TodoController::class, 'create']);
    /*read*/
    Route::get('get-todo/{id}', [TodoController::class, 'index']);
    /*update*/
    Route::post('update-todo/', [TodoController::class, 'update']);
    /*delete*/
    Route::get('delete-todo/{id}', [TodoController::class, 'delete']);
    /*mark check*/
    Route::get('check-done-todo/{id}', [TodoController::class, 'checkDone']);
    /*uncheck*/
    Route::get('un-check-done-todo/{id}', [TodoController::class, 'unCheck']);
});



//Route::post('login', [AuthController::class, 'login'])->name('login');

//    Route::get('user', [AuthController::class, 'user']);








