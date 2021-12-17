
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
});
