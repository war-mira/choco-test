const { mix } = require('laravel-mix');
mix.disableNotifications();
/*
 |------------------------------------------------ --------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */
mix
    .babel([
    'resources/assets/js/libs/Filters.js'
], 'public/js/libs/Filters.js');

mix.js('resources/assets/js/app.js', 'public/js')
    .scripts([
        'resources/assets/js/plugins/jquery.min.js',
        'resources/assets/js/plugins/jquery-masked-input.js',
        'resources/assets/js/plugins/slick.min.js',
        'resources/assets/js/plugins/lightbox.min.js',
        'resources/assets/js/plugins/selectize.min.js',
        'resources/assets/js/plugins/pickmeup.min.js',
        'resources/assets/js/plugins/jquery.magnific-popup.min.js',
        // 'resources/assets/js/plugins/scripts.js'
    ],'public/js/all.js')

   .sass('resources/assets/sass/app.scss', 'public/css')
   .options({
        processCssUrls: false
    })
   .version();
