<?php

use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('item')->group(function () {
    Route::get('/create', [ItemController::class, 'create'])->name('item.create');
    Route::post('/store', [ItemController::class, 'store'])->name('item.store');
    Route::get('/edit/{id}',  [ItemController::class, 'edit'])->name('item.edit');
    Route::put('/update/{id}',  [ItemController::class, 'update'])->name('item.update');
    Route::delete('/delete/{id}',  [ItemController::class, 'destroy'])->name('item.destroy');
});
