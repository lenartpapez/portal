const mix = require('laravel-mix');
const VueLoaderPlugin = require('vue-loader/lib/plugin');

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

mix.autoload({
        jquery: ['$', 'window.jQuery', 'jQuery', 'jquery']
    })
    .js('resources/js/app.js', 'public/js/admin')
    .js('resources/js/frontvue.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .version();

mix.webpackConfig({

    resolve: {
        extensions: ['.js', '.vue'],
    },

    plugins: [
        new VueLoaderPlugin()
    ]
});
