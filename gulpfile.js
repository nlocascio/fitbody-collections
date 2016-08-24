var elixir = require('laravel-elixir');

require('laravel-elixir-vueify');

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

elixir(function(mix) {
    mix.sass('app.scss')
        .browserSync({
            files: [
                elixir.config.appPath + '/**/*.php',
                elixir.config.get('public.css.outputFolder') + '/**/*.css',
                elixir.config.get('public.versioning.buildFolder') + '/rev-manifest.json',
                'resources/views/**/*.php'
            ],
            proxy: 'collections.dev'
        })
        .browserify('app.js')
        .phpUnit()
    ;
});
