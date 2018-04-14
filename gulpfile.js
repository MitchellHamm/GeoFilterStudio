var elixir = require('laravel-elixir');

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
    mix.sass([
        'app.scss',
        'sweetalert2.min.css',
        'jquery-ui.min.css']);
});

elixir(function(mix) {
    mix.scripts([
        'jquery-3.1.0.min.js',
        'bootstrap.min.js',
        'sweetalert2.min.js',
        'jquery-ui.min.js'
    ]);
});