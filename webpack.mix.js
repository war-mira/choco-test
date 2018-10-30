
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
/**
 * Admin panel editor
 */
mix
    .babel([
        'resources/assets/packages/longrid-js/js/helpers/*.js',
        'resources/assets/packages/longrid-js/js/elements/*.js',
        'resources/assets/packages/longrid-js/js/column.js',
        'resources/assets/packages/longrid-js/js/row.js',
        'resources/assets/packages/longrid-js/js/grid.js',
        'resources/assets/packages/longrid-js/js/index.js',
    ], 'public/projects/longrid-js/pre-build/app.js')
    .sass('resources/assets/packages/longrid-js/scss/main.scss','public/projects/longrid-js/pre-build/editor.css')
    .styles([
        'node_modules/medium-editor/dist/css/medium-editor.css',
        'node_modules/medium-editor/dist/css/themes/default.css',
        'public/projects/longrid-js/pre-build/editor.css'
    ], 'public/projects/longrid-js/css/editor.css')
    .combine([
        'node_modules/medium-editor/dist/js/medium-editor.min.js',
        'node_modules/medium-editor-autolist/dist/autolist.min.js',
        'node_modules/sortablejs/Sortable.min.js',
        'public/projects/longrid-js/pre-build/app.js',
    ],'public/projects/longrid-js/js/editor.js')
    .copy('node_modules/dropzone/dist', 'public/projects/libs/dropzone/')
;
/**
 * END
 */



mix
    .babel([
    'resources/assets/js/libs/Filters.js'
], 'public/build/js/libs/Filters.js');




mix.js('resources/assets/js/app.js', 'public/build/js/vue_app.js')
    .scripts([
        'resources/assets/js/plugins/jquery.min.js',
        'resources/assets/js/plugins/jquery-masked-input.js',
        'resources/assets/js/plugins/infinite-scroll.min.js',
        'resources/assets/js/plugins/slick.min.js',
        'resources/assets/js/plugins/selectize.min.js',
        'resources/assets/js/plugins/pickmeup.min.js',
        'resources/assets/js/plugins/jquery.magnific-popup.min.js',
        'resources/assets/js/plugins/photo-gallery.js',
        'node_modules/toastr/build/toastr.min.js',
    ], 'public/build/js/all.js')
    .babel([
        'resources/assets/js/plugins/scripts.js',
    ], 'public/build/js/scripts.js')
    .babel([
        'resources/assets/js/plugins/form_sender.js',
    ], 'public/build/js/vanilla_plugins.js')
    .sass('resources/assets/sass/app.scss', 'public/build/css')
    .combine([
        'public/build/js/all.js',
        'public/build/js/scripts.js',
        'public/build/js/vue_app.js',
        'public/build/js/vanilla_plugins.js',
        'resources/assets/js/plugins/validation.js',
    ],'public/build/js/app.js')
    .options({
        processCssUrls: false,
        postCss: [
            require('postcss-css-variables')()
        ],
    })
    .version();
