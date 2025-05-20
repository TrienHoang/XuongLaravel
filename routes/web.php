<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RoleController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\HomeController;


Route::get('/', [HomeController::class, 'home'])->name('client.home');


Route::get('/auth', [AuthController::class, 'index'])->name('auth');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::group(['prefix' => 'cart', 'as' => 'cart.', 'middleware' => 'auth'], function () {
    Route::get('list-cart', [CartController::class, 'listCart'])->name('listCart');
    Route::post('add-cart', [CartController::class, 'addToCart'])->name('addToCart');
    Route::post('update/{id}', [CartController::class, 'update'])->name('update');
    Route::delete('remove/{id}', [CartController::class, 'remove'])->name('remove');
});

Route::group([
    'prefix' => 'client',
    'as' => 'client.',
], function () {
    Route::get('home', [HomeController::class, 'home'])->name('home');
    Route::get('/product/{id}', [ProductController::class, 'showProduct'])->name('showProduct');
});

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
        'as' => 'categories.',
        'middleware' => 'check_permission:view_categories'
    ], function () {
        Route::get('/', [CategoryController::class, 'listCategory'])->name('listCategory');
    
        Route::get('add-category', [CategoryController::class, 'addCategory'])
            ->middleware('check_permission:create_categories')->name('addCategory');
    
        Route::post('add-category', [CategoryController::class, 'addPostCategory'])
            ->middleware('check_permission:create_categories')->name('addPostCategory');
    
        Route::delete('delete-category/{id}', [CategoryController::class, 'deleteCategory'])
            ->middleware('check_permission:delete_categories')->name('deleteCategory');
    
        Route::get('detail-category/{id}', [CategoryController::class, 'detailCategory'])
            ->middleware('check_permission:view_categories')->name('detailCategory');
    
        Route::get('update-category/{id}', [CategoryController::class, 'updateCategory'])
            ->middleware('check_permission:edit_categories')->name('updateCategory');
    
        Route::patch('update-category/{id}', [CategoryController::class, 'updatePatchCategory'])
            ->middleware('check_permission:edit_categories')->name('updatePatchCategory');
    });
    
    // Nhóm sản phẩm
    Route::group([
        'prefix' => 'products',
        'as' => 'products.',
    ], function () {
        Route::get('/', [ProductController::class, 'listProduct'])
            ->middleware('check_permission:view_products')
            ->name('listProduct');
    
        Route::get('add-product', [ProductController::class, 'addProduct'])
            ->middleware('check_permission:create_products')->name('addProduct');
    
        Route::post('add-product', [ProductController::class, 'addPostProduct'])
            ->middleware('check_permission:create_products')->name('addPostProduct');
    
        Route::delete('delete-product/{id}', [ProductController::class, 'deleteProduct'])
            ->middleware('check_permission:delete_products')->name('deleteProduct');
    
        Route::get('detail-product/{id}', [ProductController::class, 'detailProduct'])
            ->middleware('check_permission:view_products')->name('detailProduct');
    
        Route::get('update-product/{id}', [ProductController::class, 'updateProduct'])
            ->middleware('check_permission:edit_products')->name('updateProduct');
    
        Route::patch('update-product/{id}', [ProductController::class, 'updatePatchProduct'])
            ->middleware('check_permission:edit_products')->name('updatePatchProduct');
    });

    // Nhóm users
    Route::group([
        'prefix' => 'users',
        'as' => 'users.',
        'middleware' => 'check_permission:view_users'
    ], function () {
        Route::get('/', [UserController::class, 'index'])->name('listUser');
    
        Route::get('add-user', [UserController::class, 'create'])
            ->middleware('check_permission:create_users')->name('addUser');
    
        Route::post('add-user', [UserController::class, 'store'])
            ->middleware('check_permission:create_users')->name('addPostUser');
    
        Route::delete('delete-user/{id}', [UserController::class, 'destroy'])
            ->middleware('check_permission:delete_users')->name('deleteUser');
    
        Route::get('update-user/{id}', [UserController::class, 'edit'])
            ->middleware('check_permission:edit_users')->name('updateUser');
    
        Route::put('update-user/{id}', [UserController::class, 'update'])
            ->middleware('check_permission:edit_users')->name('updatePatchUser');
    });

    // Nhóm roles
    Route::group([
        'prefix' => 'roles',
        'as' => 'roles.'
    ], function () {
        Route::get('/', [RoleController::class, 'index'])
        ->middleware('check_permission:view_roles')
        ->name('index');

    Route::get('/create', [RoleController::class, 'create'])
        ->middleware('check_permission:create_users')
        ->name('create');

    Route::post('/', [RoleController::class, 'store'])
        ->middleware('check_permission:create_users')
        ->name('store');

    Route::get('/{role}/edit', [RoleController::class, 'edit'])
        ->middleware('check_permission:edit_roles')
        ->name('edit');

    Route::put('/{role}', [RoleController::class, 'update'])
        ->middleware('check_permission:edit_roles')
        ->name('update');

    Route::get('/{role}', [RoleController::class, 'show'])
        ->middleware('check_permission:view_roles')
        ->name('show');

    Route::delete('/{role}', [RoleController::class, 'destroy'])
        ->middleware('check_permission:delete_users')
        ->name('destroy');
    });

});
