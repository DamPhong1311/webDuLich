<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DestinationActionController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\Admin\DestinationController as AdminDestinationController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CommentController;

// Trang chủ
Route::get('/', [HomeController::class, 'index'])->name('home');

// Dashboard (chỉ user login)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile (user login)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

// ======================= PUBLIC ======================= //
// Destinations: chỉ xem danh sách + chi tiết
Route::resource('destinations', DestinationController::class)->only(['index', 'show']);

//articles
Route::resource('articles', ArticleController::class);

// Contact form
Route::get('/contact', [ContactController::class, 'showForm'])->name('contact.form');
Route::post('/contact', [ContactController::class, 'submitForm'])->name('contact.submit');

// ======================= ADMIN ======================= //
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    Route::resource('destinations', AdminDestinationController::class);
    Route::resource('articles', AdminArticleController::class);
    Route::resource('contacts', AdminContactController::class)->only(['index', 'show', 'destroy']);
});
Route::get('/bai-viet/{article:slug}', [ArticleController::class, 'show'])->name('articles.show');
Route::get('/diem-den/{destination:slug}', [DestinationController::class, 'show'])->name('destinations.show');
Route::middleware('auth')->group(function () {
    Route::post('/comments/article/{article:slug}', [CommentController::class, 'storeForArticle'])->name('comments.store.article');
    Route::post('/comments/destination/{destination:slug}', [CommentController::class, 'storeForDestination'])->name('comments.store.destination');
});
Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])
    ->middleware('auth')
    ->name('comments.destroy');
Route::middleware(['auth'])->group(function () {

    Route::get('/saved-destinations', [DestinationActionController::class, 'savedDestinations'])->name('destinations.saved');

    Route::post('/destinations/{slug}/toggle-favorite', [DestinationActionController::class, 'toggleFavorite'])->name('destinations.toggleFavorite');

    Route::post('/destinations/{slug}/toggle-save', [DestinationActionController::class, 'toggleSave'])->name('destinations.toggleSave');

});
