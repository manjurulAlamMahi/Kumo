<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\frontEndController;
use App\Http\Controllers\categoryController;

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

// FrontEnd Routes Start ###########################
Route::get('/', [App\Http\Controllers\frontEndController::class, 'welcome'])->name('index');


// Dashboard Routes Start ##########################
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Category Routes Start 
Route::get('/category/add', [App\Http\Controllers\categoryController::class, 'category_add'])->name('category_add');
Route::post('/category/store', [App\Http\Controllers\categoryController::class, 'category_store'])->name('category_store');
Route::get('/category/list', [App\Http\Controllers\categoryController::class, 'category_view'])->name('category_view');
Route::get('/category/soft/delete/{category_id}', [App\Http\Controllers\categoryController::class, 'category_soft_delete'])->name('category_soft_delete');
Route::get('/category/trashed', [App\Http\Controllers\categoryController::class, 'category_trash'])->name('category_trash');
Route::get('/category/restore/{category_id}', [App\Http\Controllers\categoryController::class, 'category_restore'])->name('category_restore');
Route::get('/category/delete/{category_id}', [App\Http\Controllers\categoryController::class, 'category_delete'])->name('category_delete');
Route::post('/category/mark/delete', [App\Http\Controllers\categoryController::class, 'category_delete_mark'])->name('category_delete_mark');
Route::get('/category/edit/{category_id}', [App\Http\Controllers\categoryController::class, 'category_edit'])->name('category_edit');
Route::post('/category/update', [App\Http\Controllers\categoryController::class, 'category_update'])->name('category_update');
// Sub-Category Routes Start


// Dashboard Routes End ##########################






