<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SubpageController;
use App\Http\Controllers\SubscriptionController;

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

Route::get('/dashboard', function () {
    $posts = \App\Models\Post::with('user')->latest()->get();
    return view('dashboard', compact('posts'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile/settings', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/settings', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/settings', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile.profile');
});



// Middleware for all the routes
Route::middleware(['auth'])->group(function () {
    // Subpage Routes
    Route::resource('subpages', SubpageController::class);
    Route::get('/subpages', [SubpageController::class, 'subscribed'])->name('subpages.subscribed'); // show all subpages - working
    Route::get('/subpages/create', [SubpageController::class, 'create'])->name('subpages.create'); // show create form for subpages - working
    Route::get('/subpages/{slug}', [SubpageController::class, 'show'])->name('subpages.show'); // show a specific subpage with slug - working
    Route::post('/subpages', [SubpageController::class, 'store'])->name('subpages.store'); // create a subpage from the create form - working

    // Subscription Routes
    Route::post('/subpages/{slug}/subscribe', [SubscriptionController::class, 'subscribe'])->name('subscribe'); // subscribe to a page
    Route::delete('/subpages/{slug}/unsubscribe', [SubscriptionController::class, 'unsubscribe'])->name('unsubscribe'); // unsubscribe to a page


    // Nested Post Routes for a subpage (using slug)
    Route::get('/subpages/{slug}/posts/create', [PostController::class, 'create'])->name('subpages.posts.create'); // not used
    Route::post('/subpages/{slug}/posts', [PostController::class, 'store'])->name('subpages.posts.store'); // create a new post inside subpage with unique slug within the subpage - working
    Route::get('/subpages/{slug}/posts/{postSlug}', [PostController::class, 'show'])->name('subpages.posts.show'); // not used
    Route::delete('/subpages/{slug}/posts/{postSlug}', [PostController::class, 'destroy'])->name('subpages.posts.destroy'); // outcommented in blog template

    // Toggle like for a post
    Route::post('/subpage/{slug}/post/{post_slug}/toggle-like', [PostController::class, 'toggleLike'])->name('posts.like.toggle');  // toggle like for a post - working

    // Delete a post
    Route::delete('/subpage/{slug}/post/{postSlug}', [PostController::class, 'destroy'])->name('subpages.posts.destroy');

    // Store a comment
    Route::post('/subpage/{slug}/post/{postSlug}/comment', [CommentController::class, 'store'])->name('posts.comments.store'); // comment a post 

    // Toggle like for a comment
    Route::post('/comments/{comment}/toggle-like', [CommentController::class, 'toggleLike'])->name('comments.like.toggle');


    

    

    

});






require __DIR__.'/auth.php';
