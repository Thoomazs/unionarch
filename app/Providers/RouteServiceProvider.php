<?php namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;

class RouteServiceProvider extends ServiceProvider
{

    /**
     * The controllers to scan for route annotations.
     *
     * @var array
     */
    protected $scan = [ ];

    /**
     * All of the application's route middleware keys.
     *
     * @var array
     */
    protected $middleware = [ 'admin'      => 'App\Http\Middleware\Admin',
                              'auth'       => 'App\Http\Middleware\Authenticated',
                              'auth.basic' => 'App\Http\Middleware\AuthenticatedWithBasicAuth',
                              'csrf'       => 'App\Http\Middleware\CsrfTokenIsValid',
                              'guest'      => 'App\Http\Middleware\IsGuest', ];

    /**
     * Called before routes are registered.
     * Register any model bindings or pattern based filters.
     *
     * @param  \Illuminate\Routing\Router $router
     *
     * @return void
     */
    public function before( Router $router )
    {
        //
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router $router
     *
     * @return void
     */
    public function map( Router $router )
    {
        require app_path( 'Http/Routes.php' );
    }

}
