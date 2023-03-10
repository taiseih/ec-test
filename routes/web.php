<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\ItemController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\UsersController;
use App\Http\Controllers\User\LikeController;


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

Route::get('/', function () {
    return view('user.welcome');
});
Route::middleware('auth:users')
    ->group(function () {
    Route::get('/user/like', [LikeController::class, 'index'])->name('likes.index');
    Route::post('/like/{productId}', [LikeController::class, 'store']);
    Route::post('/dislike/{productId}', [LikeController::class, 'destroy']);
});

Route::middleware('auth:users')
->group(function () {
    Route::get('/user', [UsersController::class, 'index'])->name('index');
    Route::get('/{user}/edit', [UsersController::class, 'edit'])->name('edit');
    Route::put('/{user}', [UsersController::class, 'update'])->name('update');
});

Route:: middleware('auth:users')
    ->group(function () {
    Route::get('/', [ItemController::class, 'index'])->name('items.index');
    Route::get('show/{item}', [ItemController::class, 'show'])->name('items.show');
});

Route::prefix('cart')
    ->middleware('auth:users')
    ->group(function(){
    Route::post('/add', [CartController::class, 'add'])->name('cart.add');
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::post('destroy/{cart}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::get('payment', [CartController::class, 'payment'])->name('cart.payment');
    Route::get('success', [CartController::class, 'success'])->name('cart.success');
    Route::get('cancel', [CartController::class, 'cancel'])->name('cart.cancel');
    });


// Route::get('/dashboard', function () {
//     return view('user.dashboard');
// })->middleware(['auth:users'])->name('dashboard');

require __DIR__.'/auth.php';
