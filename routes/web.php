<?php

use Illuminate\Support\Facades\Route;

Route::middleware('CheckLogin')->group(function (){
    Route::get('/', "UsersController@index")->name('home');
    Route::get('/register', "UsersController@register")->name('register');
    Route::post('/login',"UsersController@login")->name('login');
    Route::post('/register',"UsersController@register_form")->name('register_form');
});
Route::middleware('auth')->group(function (){
    Route::get('/logout', function (){
        \Illuminate\Support\Facades\Auth::logout();
        return redirect('/');
    })->name('logout');
    Route::get('/dashboard', "DashboardController@index")->name('dashboard');
    Route::get('/product', "ProductController@index")->name('product');
    Route::get('/product/create', "ProductController@create")->name('product_create');
    Route::post('/product/store', "ProductController@store")->name('product_store');
    Route::post('/product/image', "ProductController@image");
    Route::get('/product/view/{id}', "ProductController@view")->name('view');
    Route::post('/category','CategoryController@create');
    Route::post('/bin','BinController@create');
    Route::post('/color','ColorController@create');
    Route::post('/size','SizeController@create');
    Route::get('/product/edit/{id}', "ProductController@edit")->name('product_edit');
    Route::post('/product/update', "ProductController@update")->name('product_update');
    Route::get('/product/filter', "ProductController@filter")->name('filter');
    Route::get('/inventory', "InventoryController@index")->name('inventory.index');
    Route::post('/location/create', "WarehouseController@create")->name('location.create');
    Route::post('/inventory/create', "InventoryController@create")->name('inventory.create');
    Route::get('/inventory/filter', "InventoryController@filter");
    Route::post('/inventory/change_count', "InventoryController@change_count");
});


