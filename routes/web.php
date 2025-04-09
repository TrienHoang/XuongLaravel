<?php

use App\Http\Controllers\Admin\ProductController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Middleware\CheckAdminMiddleware;

Route::get('/', function () {
    return view('client.home');
})->name('client.home');


Route::get('/auth', [AuthController::class, 'index'])->name('auth');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => 'checkAdmin'
], function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    // Nhóm categories
    Route::group([
        'prefix' => 'categories',
        'as' => 'categories.'
    ], function () {
        Route::get('/', [CategoryController::class, 'listCategory'])->name('listCategory');
        Route::get('add-category', [CategoryController::class, 'addCategory'])->name('addCategory');
        Route::post('add-category', [CategoryController::class, 'addPostCategory'])->name('addPostCategory');
        Route::delete('delete-category/{id}', [CategoryController::class, 'deleteCategory'])->name('deleteCategory');
        Route::get('detail-category/{id}', [CategoryController::class, 'detailCategory'])->name('detailCategory');
        Route::get('update-category/{id}', [CategoryController::class, 'updateCategory'])->name('updateCategory');
        Route::patch('update-category/{id}', [CategoryController::class, 'updatePatchCategory'])->name('updatePatchCategory');
    });

    Route::group([
        'prefix' => 'products',
        'as' => 'products.',    
    ], function () {
        Route::get('/', [ProductController::class, 'listProduct'])->name('listProduct');
        Route::get('add-product', [ProductController::class, 'addProduct'])->name('addProduct');
        Route::post('add-product', [ProductController::class, 'addPostProduct'])->name('addPostProduct');
        Route::delete('delete-product/{id}', [ProductController::class, 'deleteProduct'])->name('deleteProduct');
        Route::get('detail-product/{id}', [ProductController::class, 'detailProduct'])->name('detailProduct');
        Route::get('update-product/{id}', [ProductController::class, 'updateProduct'])->name('updateProduct');
        Route::patch('update-product/{id}', [ProductController::class, 'updatePatchProduct'])->name('updatePatchProduct');
    });

    // Nhóm users
    Route::group([
        'prefix' => 'users',
        'as' => 'users.'
    ], function () {
        Route::get('/', [UserController::class, 'index'])->name('listUser');
        Route::get('add-user', [UserController::class, 'create'])->name('addUser');
        Route::post('add-user', [UserController::class, 'store'])->name('addPostUser');
        Route::delete('delete-user/{id}', [UserController::class, 'destroy'])->name('deleteUser');
        // Route::get('detail-user/{id}', [UserController::class, ''])->name('detailUser'); 
        Route::get('update-user/{id}', [UserController::class, 'edit'])->name('updateUser');
        Route::patch('update-user/{id}', [UserController::class, 'update'])->name('updatePatchUser');
    });

});
