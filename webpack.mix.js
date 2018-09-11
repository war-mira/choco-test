const { mix } = require('laravel-mix');

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
mix
    .babel([
        'resources/assets/packages/lvg/js/*.js'
    ], 'public/projects/lvg/js/app.js')
    .sass('resources/assets/packages/lvg/scss/app.scss', 'public/projects/lvg/css/app.css')
    .options({
        processCssUrls: false,
        postCss: [
            require('postcss-css-variables')()
        ]
    })
    .copy('resources/assets/packages/lvg/img','public/projects/lvg/img')
    ;
mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');

//mix.browserSync('localhost:8000');
mix.version();
