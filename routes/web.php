
<?php

use Illuminate\Support\Facades\Route;

Route::middleware('CheckLogin')->group(function (){
    Route::get('/', "UsersController@index")->name('home');
    Route::get('/register', "UsersController@register")->name('register');
    Route::post('/login',"UsersController@login")->name('login');
    Route::post('/register',"UsersController@register_form")->name('register_form');
});
Route::middleware('auth')->group(function (){
    Route::get('/logout','UsersController@logout')->name('logout');
    Route::get('/dashboard', "DashboardController@index")->name('dashboard');
    Route::get('/product', "ProductController@index")->name('product');
    Route::get('/product/create', "ProductController@create")->name('product_create');
    Route::post('/product/store', "ProductController@store")->name('product_store');
    Route::post('/product/image', "ProductController@image");
    Route::get('/product/view/{id}', "ProductController@view")->name('view');
    Route::get('/product/delete/{id}', "ProductController@delete");
    Route::post('/category','CategoryController@create');
    Route::post('/bin','BinController@create');
    Route::post('/color','ColorController@create');
    Route::post('/size','SizeController@create');
    Route::get('/product/edit/{id}', "ProductController@edit")->name('product_edit');
    Route::post('/product/update', "ProductController@update")->name('product_update');
    Route::get('/product/filter', "ProductController@filter")->name('filter');
    Route::get('/inventory', "InventoryController@index")->name('inventory.index');
    Route::post('/location/create', "WarehouseController@create")->name('location.create');
    Route::get('/location', "WarehouseController@index")->name('location.index');
    Route::get('/location/filter', "WarehouseController@filter");
    Route::get('/location/edit/{id}', "WarehouseController@edit");
    Route::post('/inventory/create', "InventoryController@create")->name('inventory.create');
    Route::get('/inventory/filter', "InventoryController@filter");
    Route::post('/inventory/change_count', "InventoryController@change_count");
    Route::post('/inventory/counts', "InventoryController@counts");
    Route::get('/inventory/transfer/{id}', "InventoryController@transfer");
    Route::post('/inventory/transfer', "InventoryController@save_transfer")->name('inventory.save.transfer');
    Route::get('/users/settings', "UsersController@settings")->name('users.settings');
    Route::post('/users/settings', "UsersController@settings_post")->name('user.settings.post');
    Route::get('/order',"OrdersController@index")->name('orders');
    Route::get('/orders/create',"OrdersController@create")->name('orders.create');
    Route::post('/channel/create',"ChannelController@create");
    Route::get('/order/state',"OrdersController@state");
});
