<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookViewController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserLibraryController;
use App\Http\Controllers\Controller;
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
// ADMIN
Route::get('/admin', [AdminController::class, 'index']);
Route::get('/admin', [AdminController::class, 'dashboard']); 
Route::get('/admin/profile', [AdminController::class, 'profile']);
Route::get('/admin/books', [AdminController::class, 'books']);
Route::get('/admin/accessory', [AdminController::class, 'accessory']);

// --ADMIN - BOOK

Route::post('/store-book', [BooksController::class, 'store']);
Route::get('/delete-book/{id}', [BooksController::class, 'destroy']);
Route::get('/book-offline/{id}', [BooksController::class, 'offline']);
Route::get('/book-online/{id}', [BooksController::class, 'online']);
Route::get('/admin/book/edit-book/{id}', [BooksController::class, 'edit']);
Route::post('/store-book-update/{id}', [BooksController::class, 'store_update']);
// --END ADMIN _ BOOK

// END ADMIN


// ADMIN CATEGORY

Route::get('/admin/category', [CategoryController::class, 'show_cate']);
Route::get('/admin/add-new', [CategoryController::class, 'add_cate']);
Route::post('/store-cate', [CategoryController::class, 'store']);
Route::get('/delete-category/{id}', [CategoryController::class, 'destroy']);
Route::get('/category-offline/{id}', [CategoryController::class, 'offline']);
Route::get('/category-online/{id}', [CategoryController::class, 'online']);

// CUS CATE
Route::get('/category', [CategoryController::class, 'index_category']);
Route::get('/category/{slug_cate}', [CategoryController::class, 'index_category_slug']);



// END CATE

// CUSTOMER
Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index'])->name('home');



Route::get('/my-library/{id}', [UserLibraryController::class, 'index']);
Route::post('/store-book-user/{user_id}', [UserLibraryController::class, 'store']);

Route::get('/book/{slug}', [BookViewController::class, 'show_book']);

// END CUS



Auth::routes();



