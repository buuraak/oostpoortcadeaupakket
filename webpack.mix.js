let mix = require('laravel-mix');
require('laravel-mix-simple-image-processing')

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

// set external scripts to prevent errors
// mix.webpackConfig({
//     externals: {
//         "react": "React",
//         "react-dom": "ReactDOM"
//     }
// });

mix.js('resources/js/app.js', 'public/js')
    .vue()
    .sass('resources/sass/app.scss', 'public/css')
    .copyDirectory('resources/images', 'public/images')

mix.imgs({
    source: 'resources/images/sinterklaas',
    destination: 'public/images/sinterklaas',
    webp: true,
})

