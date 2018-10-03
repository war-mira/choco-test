
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


mix
    .babel([
    'resources/assets/js/libs/Filters.js'
], 'public/build/js/libs/Filters.js');


mix.js('resources/assets/js/app.js', 'public/build/js/vue_app.js')
    .scripts([
        'resources/assets/js/plugins/jquery.min.js',
        'resources/assets/js/plugins/jquery-masked-input.js',
        'resources/assets/js/plugins/slick.min.js',
        'resources/assets/js/plugins/selectize.min.js',
        'resources/assets/js/plugins/pickmeup.min.js',
        'resources/assets/js/plugins/jquery.magnific-popup.min.js',
        'node_modules/toastr/build/toastr.min.js',
    ], 'public/build/js/all.js')
    .babel([
        'resources/assets/js/plugins/scripts.js'
    ], 'public/build/js/scripts.js')
    .sass('resources/assets/sass/app.scss', 'public/build/css')
    .combine([
        'public/build/js/all.js',
        'public/build/js/scripts.js',
        'public/build/js/vue_app.js',
    ],'public/build/js/app.js')
    .options({
        processCssUrls: false,
        postCss: [
            require('postcss-css-variables')()
        ],
    })
    .version();
