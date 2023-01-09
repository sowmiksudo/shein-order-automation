<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Models\Order;

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


Route::get('/ip', [OrderController::class, 'ip']);

Route::get('/', function(){
    return redirect()->route('dashboard');
});

Route::middleware(['auth', 'verified'])
    ->resource('dashboard', OrderController::class)
    ->name('index', 'dashboard')
    ->name('show', 'order');

Route::middleware(['auth', 'verified'])->group(function(){
    Route::get('product/{id}', [OrderController::class, 'product']);
    Route::get('retry/{id}', [OrderController::class, 'retry'])->name('orders.retry');
    Route::post('/export', [OrderController::class, 'export'])->name('export');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/artisan/{q}', function($q = ""){
    Artisan::call($q);
    return Artisan::output();
});
require __DIR__ . '/auth.php';
