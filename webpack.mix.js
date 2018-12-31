const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix // Laravel asset runner

   // Application scaffolding
   .js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')

   // Authentication scaffolding 
   .sass('resources/sass/auth.scss', 'public/css') 
   .js('resources/js/auth.js', 'public/js');