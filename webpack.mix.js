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
 .sass('resources/sass/app.scss', 'public/css')
 .copy('node_modules/admin-lte/dist/css', 'public/css/adminlte')
 .copy('node_modules/admin-lte/dist/js', 'public/js/adminlte')
 .copy('node_modules/admin-lte/dist/img', 'public/img/adminlte');


 const webpack = require('webpack');
 
 mix.js('resources/js/app.js', 'public/js')
    .webpackConfig({
        plugins: [
            new webpack.DefinePlugin({
                'process.env': JSON.stringify(process.env)
            })
        ]
    })
    .sass('resources/sass/app.scss', 'public/css');