const mix = require('laravel-mix');

// Compile your CSS
mix.css('resources/css/app.css', 'public/css')
    .js('resources/js/app.js', 'public/js');
