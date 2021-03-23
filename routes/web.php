<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::resource('users', UserController::class)->middleware('role:admin')->except('show');
});

// route prefix - prefix('video')
// route name prefix - name('video.')
Route::middleware(['auth'])->prefix('video')->name('video.')->group(function () {
    Route::get('/channel/{id}', [VideoController::class, 'index'])->withoutMiddleware(['auth'])->name('index');
    Route::get('/create', [VideoController::class, 'create'])->name('create');
    Route::post('/store', [VideoController::class, 'store'])->name('store');
    Route::get('/{video}/show', [VideoController::class, 'show'])->withoutMiddleware(['auth'])->name('show');
    Route::get('/{video}/edit', [VideoController::class, 'edit'])->name('edit');
    Route::put('/{video}/update', [VideoController::class, 'update'])->name('update');
    Route::delete('/{video}/destroy', [VideoController::class, 'destroy'])->name('destroy');
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

// grouping properly
// Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function(){});