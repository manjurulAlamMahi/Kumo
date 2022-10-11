<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\frontEndController;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\subCategoryController;

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

// Sub-Category Routes Start
Route::get('/subCategory/add', [App\Http\Controllers\subCategoryController::class, 'subCategory_add'])->name('subCategory_add');
Route::post('/subCategory/store', [App\Http\Controllers\subCategoryController::class, 'subCategory_store'])->name('subCategory_store');
Route::get('/subCategory/view/list', [App\Http\Controllers\subCategoryController::class, 'subCategory_list'])->name('subCategory_list');
Route::get('/subcategory/soft/delete/{subcategory_id}', [App\Http\Controllers\subCategoryController::class, 'subcategory_soft_delete'])->name('subcategory_soft_delete');
Route::get('/subcategory/trashed', [App\Http\Controllers\subCategoryController::class, 'subcategory_trash'])->name('subcategory_trash');
Route::get('/subcategory/edit/{subcategory_id}', [App\Http\Controllers\subCategoryController::class, 'subcategory_edit'])->name('subcategory_edit');
Route::post('/category/update', [App\Http\Controllers\subCategoryController::class, 'subcategory_update'])->name('subcategory_update');
Route::get('/subcategory/restore/{subcategory_id}', [App\Http\Controllers\subCategoryController::class, 'subcategory_restore'])->name('subcategory_restore');
Route::get('/subcategory/delete/{subcategory_id}', [App\Http\Controllers\subCategoryController::class, 'subcategory_delete'])->name('subcategory_delete');
Route::post('/subcategory/mark/delete', [App\Http\Controllers\subCategoryController::class, 'subcategory_delete_mark'])->name('subcategory_delete_mark');

// Products Routes Start
Route::get('/product/add', [App\Http\Controllers\productController::class, 'product_add'])->name('product_add');
Route::post('/getsubcategory', [App\Http\Controllers\productController::class, 'getsubcategory'])->name('getsubcategory');
Route::post('/product/store', [App\Http\Controllers\productController::class, 'product_store'])->name('product_store');
Route::get('/product/list', [App\Http\Controllers\productController::class, 'product_list'])->name('product_list');
Route::get('/product/details/{product_slug}', [App\Http\Controllers\productController::class, 'product_details'])->name('product_details');
Route::get('/product/edit/name/{product_id}', [App\Http\Controllers\productController::class, 'product_edit_name'])->name('product_edit_name');
Route::get('/product/edit/category/{product_id}', [App\Http\Controllers\productController::class, 'product_edit_category'])->name('product_edit_category');

// Dashboard Routes End ##########################






