const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/admin/Section.js', 'public/js/admin')
    .js('resources/js/user/Users.js', 'public/js/user')
    .js('resources/js/admin/Category.js', 'public/js/admin')
    .postCss('resources/css/app.css', 'public/css', [
        //
    ]);
mix.postCss('resources/css/style.css', 'public/css', [

]);
