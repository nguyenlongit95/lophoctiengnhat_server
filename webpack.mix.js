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

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');
mix.sass('resources/css/CustomStyle.scss', 'public/css/');
mix.sass('resources/css/frontend/CustomStyle.scss', 'public/css/frontend');
mix.js('resources/js/playAudio.js', 'public/js');
mix.js('resources/js/pages/dashboard.js', 'public/js/pages/dashboard');
mix.js('resources/js/pages/menus.js', 'public/js/pages/menus');
mix.js('resources/js/pages/page.js', 'public/js/pages/menus');
mix.js('resources/js/pages/course_online.js', 'public/js/pages/course');
mix.js('resources/js/pages/course_level.js', 'public/js/pages/course');
mix.js('resources/js/pages/course_thematic.js', 'public/js/pages/course');
mix.js('resources/js/pages/course_free.js', 'public/js/pages/course');
