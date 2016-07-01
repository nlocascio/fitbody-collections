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
        // .copy('node_modules/sweetalert/dist/sweetalert.min.js', 'public/js/sweetalert.min.js')
        // .copy('node_modules/sweetalert/dist/sweetalert.css', 'public/css/sweetalert.css')
        // .phpUnit()
    ;

    // mix.styles([
    //     '../../../resources/assets/compiled/app.css',
    //     '../../../vendor/bower_components/bootstrap-multiselect/dist/css/bootstrap-multiselect.css',
    //     '../../../vendor/bower_components/font-awesome/css/font-awesome.min.css',
    //     '../../../vendor/theme-dashboard/dist/toolkit-inverse.min.css'
    // ]);

    // mix.copy([
        // 'vendor/theme-dashboard/fonts',
        // 'vendor/bower_components/font-awesome/fonts',
        // ], 'public/build/fonts')

    // mix.copy([
    //     'vendor/bower_components/jquery/dist/jquery.min.js',
    //     'vendor/bower_components/jquery.hotkeys/jquery.hotkeys.js',
    //     'vendor/bower_components/tablesorter/jquery.tablesorter.min.js',
    //     'vendor/bower_components/angular/angular.min.js',
    //     'vendor/bower_components/bootstrap/dist/js/bootstrap.min.js',
    //     'vendor/bower_components/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js',
    //     'vendor/bower_components/bootstrap-multiselect/dist/js/bootstrap-multiselect.js',
    //     'vendor/bower_components/Chart.js/Chart.min.js',
    //     'vendor/theme-dashboard/js/custom/chartjs-data-api.js',
    //     'vendor/bower_components/pusher/dist/pusher.min.js',
    // ], 'public/js');

    // mix.scripts(['app.js'], 'public/js/app.js');

    // mix.version([
    //     'css/all.css',
    //     'js/app.js'
    // ]);
});
