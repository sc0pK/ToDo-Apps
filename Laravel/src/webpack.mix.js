const mix = require('laravel-mix');
const glob = require('glob');

glob.sync('resources/sass/*.scss').map(function(file) {
  mix.sass(file, 'public/css');
});

mix.js('resources/js/app.js', 'public/js').vue();
