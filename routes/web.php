<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AuthorController;
use \App\Http\Controllers\UserController;
use \App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::post('/signup' , [UserController::class , "postSignUp"])->name('signup');
Route::post('/signin' , [UserController::class  ,"postSignIn"])->name('signin');
Route::get('/dashboard', [PostController::class , "getDashboard"])->name('dashboard')->middleware('auth');
Route::post('/createpost', [PostController::class , "postCreatePost"])->name('createpost')->middleware('auth');
Route::get('/post-delete/{post_id}' , [PostController::class , "getDeletePost"])->name('post-delete')->middleware('auth');
Route::get('/logout' , [UserController::class , 'getLogout'])->name('logout');

 
// Route::get('/' , function (){
//     return view('welcome');
// })->name('home');

// Route::post('/signup', [
//     'uses' => 'UserController@postSignUp',
//     'as' => 'signup'
// ]);

// Route::post('/signin', [
//     'uses' => 'UserController@postSignIn',
//     'as' => 'signin'
// ]);

// Route::get('/dashboard', [
//     'uses' => 'UserController@getDashboard',
//     'as' => 'dashboard',
//     'middleware' => 'auth' 
// ]);
 