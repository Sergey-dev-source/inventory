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
    .js('resources/js/page/product.js', 'public/js/page')
    .js('resources/js/page/product_index.js', 'public/js/page')
    .js('resources/js/page/inventory.js', 'public/js/page')
    .js('resources/js/page/inventory_ajax.js', 'public/js/page')
    .js('resources/js/page/order.js', 'public/js/page')
    .js('resources/js/page/order_index.js', 'public/js/page')
    .postCss('resources/css/app.css', 'public/css', [
        //
    ]);
mix.postCss('resources/css/style.css', 'public/css', [

]);