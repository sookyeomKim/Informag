const elixir = require('laravel-elixir');
require('laravel-elixir-fonts');

const bowerDir = './resources/assets/bower/';

/*require('laravel-elixir-vue-2');*/

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
    mix.copy('vendor/bower_components/bootstrap/fonts/**',
        'public/build/fonts');

    mix.copy('vendor/bower_components/bootstrap/dist/css/bootstrap.min.css', 'public/css/vendor/bootstrap.css');

    mix.copy('vendor/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css', 'public/css/vendor/bootstrap-datepicker.css');

    mix.copy('vendor/bower_components/bootstrap-fileinput/css/fileinput.min.css', 'public/css/vendor/bootstrap-fileinput.css');

    mix.copy('vendor/bower_components/jquery/dist/jquery.min.js', 'public/js/vendor/jquery.js');

    mix.copy('vendor/bower_components/bootstrap/dist/js/bootstrap.min.js', 'public/js/vendor/bootstrap.js');

    mix.copy('vendor/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js', 'public/js/vendor/bootstrap-datepicker.js');

    mix.copy('vendor/bower_components/bootstrap-fileinput/js/plugins/purify.min.js', 'public/js/vendor/purify.js');

    mix.copy('vendor/bower_components/bootstrap-fileinput/js/plugins/sortable.min.js', 'public/js/vendor/sortable.js');

    mix.copy('vendor/bower_components/bootstrap-fileinput/js/fileinput.min.js', 'public/js/vendor/bootstrap-fileinput.js');

    //compiled main.css
    mix.styles(['vendor/bootstrap.css'], 'public/css/main.css', 'public/css');

    //compiled landing-create.css
    mix.styles(['vendor/bootstrap-datepicker.css', 'vendor/bootstrap-fileinput.css'], 'public/css/landing-create.css', 'public/css');

    //compiled main.js
    mix.scripts(['vendor/jquery.js', 'vendor/bootstrap.js'], 'public/js/main.js', 'public/js');

    //compiled landing-create.js
    mix.scripts(['vendor/bootstrap-datepicker.js', 'vendor/purify.js', 'vendor/sortable.js', 'vendor/bootstrap-fileinput.js'], 'public/js/landing-create.js', 'public/js');

    mix.version(['css/main.css', 'css/landing-create.css', 'js/main.js', 'js/landing-create.js']);
});
