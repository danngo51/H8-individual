<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;

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
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile/settings', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/settings', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/settings', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile.profile');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
});

Route::get('/dashboard', function () {
    $posts = \App\Models\Post::with('user')->latest()->get();
    return view('dashboard', compact('posts'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/posts/{post}/comments', [CommentController::class, 'store'])->name('posts.comments.store');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::post('/posts/{post}/toggle-like', [PostController::class, 'toggleLike'])->name('posts.like.toggle');

Route::post('/comments/{comment}/toggle-like', [CommentController::class, 'toggleLike'])
    ->name('comments.like.toggle');

require __DIR__.'/auth.php';
