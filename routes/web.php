
<?php

use Illuminate\Support\Facades\Route;

Route::get('/', "DashboardController@index")->name('home');
Route::middleware('CheckLogin')->group(function (){
    Route::get('/register', "UsersController@register")->name('register');
    Route::post('/login',"UsersController@login")->name('login');
    Route::post('/register',"UsersController@register_form")->name('register_form');
});
Route::middleware('auth')->group(function (){

    Route::middleware('CheckRole')->group(function (){
        Route::get('/admin/dashboard', "admin\DashboardController@index")->name('admin.dashboard');
        Route::get('/admin/section',"SectionController@index")->name('admin.section');
        Route::post('/section/store',"SectionController@store");
        Route::post('/section/edit',"SectionController@edit");
        Route::post('/section/delete',"SectionController@delete");
        Route::post('/section/search',"SectionController@search");
        Route::get('/section/show',"SectionController@show");
    });
    Route::get('/logout','UsersController@logout')->name('logout');
});
