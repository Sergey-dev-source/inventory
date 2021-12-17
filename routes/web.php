
<?php

use Illuminate\Support\Facades\Route;

Route::get('/', "DashboardController@index")->name('home');
Route::middleware('CheckLogin')->group(function (){
    Route::get('/register', "UsersController@register")->name('register');
    Route::post('/login',"UsersController@login")->name('login');
    Route::post('/register',"UsersController@register_form")->name('register_form');
});
Route::middleware('auth')->group(function (){
    Route::get('/logout','UsersController@logout')->name('logout');
    Route::get('/admin/dashboard', "admin\DashboardController@index")->name('admin.dashboard');
});