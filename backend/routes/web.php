
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
//        dashboard

        Route::get('/admin/dashboard', "admin\DashboardController@index")->name('admin.dashboard');

//       section

        Route::get('/admin/section',"SectionController@index")->name('admin.section');
        Route::post('/section/store',"SectionController@store");
        Route::post('/section/edit',"SectionController@edit");
        Route::post('/section/delete',"SectionController@delete");
        Route::get('/section/show',"SectionController@show");
        Route::get('/section/shows',"SectionController@shows");

//        category

        Route::get('/admin/category',"CategoryController@index")->name('admin.category');
        Route::get('/admin/getsection',"CategoryController@getsection");
        Route::post('/category/story','CategoryController@story');
        Route::get('/category/show',"CategoryController@show");
        Route::get('/category/shows',"CategoryController@shows");
        Route::post('/category/edit','CategoryController@edit');
        Route::post('/category/delete','CategoryController@delete');

//        slide bar

        Route::get('/admin/sliders','SlidebarController@index')->name('admin.slidebar');
        Route::post('/sliders/store','SlidebarController@store');
        Route::get('/sliders/show','SlidebarController@show');
        Route::get('/sliders/shows','SlidebarController@shows');
        Route::post('/sliders/edit','SlidebarController@edit');
        Route::post('/sliders/delete','SlidebarController@delete');

    });
    Route::get('/logout','UsersController@logout')->name('logout');
});
