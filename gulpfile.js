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
     mix.styles([
         'bootstrap.css',
         'main.css'
     ])
     .scripts([
         'jquery.js',
         'bootstrap.js',
         'activelink.js',
         'vue.js',
         'fastclick.js',
         'main.js'
     ])
     .version(["css/all.css", "js/all.js"]);
     mix.copy('resources/assets/fonts/roboto.woff2', 'public/fonts/roboto.woff2');
 });
