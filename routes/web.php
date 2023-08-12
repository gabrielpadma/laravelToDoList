<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TodoListController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\OnlyGuestMiddleWware;
use App\Http\Middleware\OnlyMemberMiddleware;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', [HomeController::class, 'home']);

Route::view('/template', 'template');

Route::controller(UserController::class)->group(function () {
    Route::get('/login', 'login')->middleware([OnlyGuestMiddleWware::class]);
    Route::post('/login', 'dologin')->middleware([OnlyGuestMiddleWware::class]);
    Route::post('/logout', 'dologout')->middleware([OnlyMemberMiddleware::class]);

});

Route::controller(TodoListController::class)->middleware([OnlyMemberMiddleware::class])->group(function () {
    Route::get('/todolist', 'todolist');
    Route::post('/todolist', 'addTodo');
    Route::post('/todolist/{id}/delete', 'removeTodo');
});
