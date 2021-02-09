<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\SubscribeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChannelController;
use App\Http\Controllers\ProfileController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('change-password', [ChangePasswordController::class, 'index'])->name('change.password');
Route::post('change-password', [ChangePasswordController::class, 'store'])->name('change.password.store');

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// route prefix - prefix('video')
// route name prefix - name('video.')
Route::middleware(['auth', 'authorized_user'])->prefix('video')->name('video.')->group(function () {
    Route::get('/channel/{id}', [VideoController::class, 'index'])->withoutMiddleware(['authorized_user'])->name('index');
    Route::get('/create', [VideoController::class, 'create'])->withoutMiddleware(['authorized_user'])->name('create');
    Route::post('/store', [VideoController::class, 'store'])->withoutMiddleware(['authorized_user'])->name('store');
    Route::get('/{id}/show', [VideoController::class, 'show'])->withoutMiddleware(['authorized_user'])->name('show');
    Route::get('/{id}/edit', [VideoController::class, 'edit'])->name('edit');
    Route::put('/{id}/update', [VideoController::class, 'update'])->name('update');
    Route::delete('/{id}/destroy', [VideoController::class, 'destroy'])->name('destroy');
});


Route::middleware('auth')->prefix('comment')->name('comment.')->group(function () {
    Route::post('/store/{id}', [CommentController::class, 'store'])->name('store');
    Route::put('/update/{id}', [CommentController::class, 'update'])->name('update');
    Route::delete('/destroy/{id}', [CommentController::class, 'destroy'])->name('destroy');
});

Route::post('/like/store/{id}', [LikeController::class, 'store'])->middleware('auth');
Route::post('/subscribe/store/{id}', [SubscribeController::class, 'store'])->middleware('auth');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/channel', [ChannelController::class, 'index'])->name('channel');
});

Route::prefix('profile')->name('profile.')->group(function () {
    Route::get('/', [ProfileController::class, 'show'])->name('show');
    Route::put('/update/{user}', [ProfileController::class, 'update'])->name('update');
});