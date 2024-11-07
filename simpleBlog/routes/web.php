<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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


Route::get('/loginReg', function () {
    return view('loginRegister');
});



Route::post('/register', [UserController::class, 'register'])->name('register');
Route::get('/loginReg', [UserController::class, 'showLoginRegForm'])->name('login.form');
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::get('/logout', [UserController::class, 'logout'])->name('logout')->middleware('auth');
Route::post('/createPost', [PostController::class, 'store'])->name('createPost');
Route::delete('/deletePost/{id}', [PostController::class, 'destroy'])->name('deletePost');
Route::PUT('/updatePost/{id}', [PostController::class, 'update'])->name('posts.update');
Route::get('/blogs', [PostController::class, 'index'])->name('blogs');
Route::post('/posts/{postId}/comments', [CommentController::class, 'store'])->name('comments.store');
Route::get('/comments/{id}/edit', [CommentController::class, 'edit'])->name('comments.edit');
Route::put('/comments/{id}', [CommentController::class, 'update'])->name('comments.update');
Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');
