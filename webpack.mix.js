<<<<<<< HEAD
const {mix} = require('laravel-mix');

=======
const { mix } = require('laravel-mix');
mix.disableNotifications();
>>>>>>> aisha-dev
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
<<<<<<< HEAD
mix.disableNotifications();
/**
 * LVG package resources
 */
mix
    .babel([
        'resources/assets/packages/lvg/js/*.js'
    ], 'public/projects/lvg/js/app.js')
    .sass('resources/assets/packages/lvg/scss/app.scss', 'public/projects/lvg/css/app.css')
    .copy('resources/assets/packages/lvg/img', 'public/projects/lvg/img')
;

=======
mix
    .babel([
    'resources/assets/js/libs/Filters.js'
], 'public/js/libs/Filters.js');
>>>>>>> aisha-dev

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
<<<<<<< HEAD
    ], 'public/js/all.js')
    .babel([
        'resources/assets/js/plugins/scripts.js'
    ], 'public/js/scripts.js')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .options({
        processCssUrls: false,
        postCss: [
            require('postcss-css-variables')()
        ]
=======
    ],'public/js/all.js')

   .sass('resources/assets/sass/app.scss', 'public/css')
   .options({
        processCssUrls: false
>>>>>>> aisha-dev
    })
    .version();
