var elixir = require('laravel-elixir');

/*
 |----------------------------------------------------------------
 | Have a Drink!
 |----------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic
 | Gulp tasks for your Laravel application. Elixir supports
 | several common CSS, JavaScript and even testing tools!
 |
 */

elixir( function( mix ) {
    mix.less( ["style.less", "style-admin.less" ] )
        .styles( ["css/bootstrap.min.css", "css/font-awesome.min.css", "css/style.css"] )
        .scripts(['js/jquery/jquery.min.js','js/helpers/bootstrap.min.js', 'js/helpers/helpers.js'])
        .version( ['css/all.min.css','js/all.min.js'] )
} );