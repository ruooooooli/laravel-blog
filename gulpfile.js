const elixir = require('laravel-elixir');

require('laravel-elixir-vue');

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
        .copy('semantic/dist/semantic.js', 'resources/assets/js/semantic.js')
        .copy('semantic/dist/semantic.css', 'resources/assets/css/semantic.css')
        .copy('semantic/dist/semantic.min.js', 'resources/assets/js/semantic.min.js')
        .copy('semantic/dist/semantic.min.css', 'resources/assets/css/semantic.min.css')
        .copy('semantic/src/themes/default/assets/fonts', 'public/assets/fonts/')
        .copy('semantic/src/themes/default/assets/images', 'public/assets/images/')

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
        ], 'public/assets/css/styles.css')

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
        ], 'public/assets/js/scripts.js')

        .version([
            'assets/css/styles.css',
            'assets/js/scripts.js',
        ]);
});
