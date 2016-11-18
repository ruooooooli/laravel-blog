const elixir    = require('laravel-elixir');
const path      = require('path');

require('laravel-elixir-vue-2');
require('laravel-elixir-webpack-official');

Elixir.webpack.config.module.loaders = [];
Elixir.webpack.mergeConfig({
    resolveLoader : {
        root : path.join(__dirname, 'node_modules'),
    },
    module : {
        loaders : [
            {
                test    : /\.js$/,
                loader  : 'babel',
                exclude : /node_modules/
            },
            {
                test    : /\.css$/,
                loader  : 'style!css'
            }
        ]
    }
});

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(mix => {
    mix
        .sass('markdown.scss', 'resources/assets/css/markdown-one.css')
        .sass('prism.scss', 'resources/assets/css/prism.css')

        .styles([
            'font.lato.css',
            'semantic.css',
            'nprogress.css',
            'sweetalert.css',
            'markdown-one.css',
            'prism.css',
            'pikaday.css',
            'main.css',
        ], 'public/assets/css/backend-styles.css')

        .scripts([
            'jquery.min.js',
            'jquery.form.min.js',
            'jquery.pjax.js',
            'marked.min.js',
            'semantic.js',
            'nprogress.js',
            'sweetalert.min.js',
            'moment.min.js',
            'zh-cn.min.js',
            'pikaday.js',
            'main.js',
        ], 'public/assets/js/backend-scripts.js')

        .webpack(
            './resources/assets/js/app.js',
            './public/assets/js'
        )

        .version([
            'assets/css/backend-styles.css',
            'assets/js/backend-scripts.js',
            'assets/js/app.js',
        ]);
});
