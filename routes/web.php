<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::middleware(['auth','record.access'])->group(function(){
    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::controller(CategoryController::class)->prefix('category')->group(function(){
        Route::get('/', 'index')->name('category.index');
        Route::get('/create', 'create')->name('category.create');
        Route::post('/', 'store')->name('category.store');
        Route::get('/{category}/edit', 'edit')->name('category.edit');
        Route::put('/{category}', 'update')->name('category.update');
        Route::delete('/{category}', 'destroy')->name('category.delete');
        Route::get('/select2', 'getSelect2')->name('category.select2');
    });

    Route::resource('book', BookController::class);
});
