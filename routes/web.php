<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Admin\DestinationController as AdminDestinationController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\DestinationActionController;
use App\Http\Controllers\MapApiController;


Route::get('/', [HomeController::class, 'index'])->name('home');

Route::resource('destinations', DestinationController::class)->only(['index', 'show']);
Route::resource('articles', ArticleController::class);
Route::get('/contact', [ContactController::class, 'showForm'])->name('contact.form');
Route::post('/contact', [ContactController::class, 'submitForm'])->name('contact.submit');

require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {
    // Dashboard & Profile
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // **CÁC ROUTES MỚI CHO YÊU THÍCH VÀ LƯU**
    Route::post('/destinations/{slug}/favorite', [DestinationActionController::class, 'toggleFavorite'])->name('destinations.toggleFavorite');
    Route::post('/destinations/{slug}/save', [DestinationActionController::class, 'toggleSave'])->name('destinations.toggleSave');
    Route::get('/saved-destinations', [DestinationActionController::class, 'savedDestinations'])->name('destinations.saved');

    Route::post('/comments/article/{article:slug}', [CommentController::class, 'storeForArticle'])->name('comments.store.article');
    Route::post('/comments/destination/{destination:slug}', [CommentController::class, 'storeForDestination'])->name('comments.store.destination');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', fn() => view('admin.dashboard'))->name('dashboard');
    Route::resource('destinations', AdminDestinationController::class);
    Route::resource('articles', AdminArticleController::class);
    Route::resource('contacts', AdminContactController::class)->only(['index', 'show', 'destroy']);
});

Route::get('/api/destinations', [MapApiController::class, 'destinations'])->name('api.destinations');
Route::get('/api/articles', [MapApiController::class, 'articles'])->name('api.articles');

Route::get('/map', function () {
    return view('map.explore');
})->name('map.explore');