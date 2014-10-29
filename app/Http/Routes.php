<?php

    /*
    |--------------------------------------------------------------------------
    | Application Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register all of the routes for an application.
    | It's a breeze. Simply tell Laravel the URIs it should respond to
    | and give it the Closure to execute when that URI is requested.
    |
    */

    Log::listen( function ( $level, $message, $context )
    {
        $log = new \App\Log();

        if ( Auth::check() )
        {
            $user = (int)Auth::user()->id;
        }
        else
        {
            $user = null;
        }

        $log->create( [ "level" => $level, "user_id" => $user, "message" => $message, "ip" => Request::ip() ] );
    } );
    /*
    |--------------------------------------------------------------------------
    | Admin Routes
    |--------------------------------------------------------------------------
    |
    */


    Route::group( [ 'prefix' => 'admin', 'middleware' => [ 'admin' ] ], function ()
    {

        Route::bind( "users", function ( $id )
        {
            return App\User::find( $id );
        } );

        Route::bind( "roles", function ( $id )
        {
            return App\Role::find( $id );
        } );

        Route::bind( "products", function ( $id )
        {
            return App\Product::find( $id );
        } );

        Route::bind( "categories", function ( $id )
        {
            return App\Category::find( $id );
        } );

        Route::resource( 'users', 'App\Http\Controllers\Admin\UsersController' );

        Route::resource( 'roles', 'App\Http\Controllers\Admin\RolesController' );

        Route::resource( 'products', 'App\Http\Controllers\Admin\ProductsController' );

        Route::resource( 'categories', 'App\Http\Controllers\Admin\CategoriesController' );

        Route::resource( 'log', 'App\Http\Controllers\Admin\LogController', [ 'only' => 'index' ] );

        Route::get( '/', [ 'as' => 'admin', 'uses' => 'App\Http\Controllers\AdminController@getDashboard' ] );
        Route::get( 'settings', [ 'as' => 'admin.settings', 'uses' => 'App\Http\Controllers\AdminController@getSetting' ] );
    } );


    /*
    |--------------------------------------------------------------------------
    | Auth, Reminders & My-Account Routes
    |--------------------------------------------------------------------------
    |
    */

    Route::group( [ 'middleware' => [ 'guest' ] ], function ()
    {
        // Login & Register

        get( 'register', [ 'as' => 'auth.register', 'uses' => 'App\Http\Controllers\User\AuthController@showRegistrationForm' ] );
        post( 'register', 'App\Http\Controllers\User\AuthController@register' );
        get( 'login', [ 'as' => 'auth.login', 'uses' => 'App\Http\Controllers\User\AuthController@showLoginForm' ] );
        post( 'login', 'App\Http\Controllers\User\AuthController@login' );

        // Password Reminders

        get( 'forget-password', [ 'as' => 'password.reset-request', 'uses' => 'App\Http\Controllers\User\PasswordController@showResetRequestForm' ] );
        post( 'forget-password', [ 'uses' => 'App\Http\Controllers\User\PasswordController@sendResetLink' ] );
        get( 'reset-password/{token}  ', [ 'as' => 'password.reset.token', 'uses' => 'App\Http\Controllers\User\PasswordController@showResetForm' ] );
        post( 'reset-password', [ 'as' => 'password.reset', 'uses' => 'App\Http\Controllers\User\PasswordController@resetPassword' ] );

    } );

    Route::group( [ 'middleware' => [ 'auth' ] ], function ()
    {
        // Logout

        get( 'logout', [ 'as' => 'auth.logout', 'uses' => 'App\Http\Controllers\User\AuthController@logout' ] );

        // User profile

        get( 'profile', [ 'as' => 'my-account.profile', 'uses' => 'App\Http\Controllers\User\MyAccountController@getProfile' ] );

    } );


    /*
        |--------------------------------------------------------------------------
        | Shop site Routes
        |--------------------------------------------------------------------------
        |
        */

    Route::bind( "product", function ( $slug )
    {
        return App\Product::whereSlug( $slug )->first();
    } );

    get( 'products', [ 'as' => 'products.index', 'uses' => 'App\Http\Controllers\Shop\ProductsController@index' ] );
    get( 'product/{product}', [ 'as' => 'products.detail', 'uses' => 'App\Http\Controllers\Shop\ProductsController@show' ] );
    post( 'shopping-cart/added-to-cart', [ 'as' => 'cart.added-to-cart', 'uses' => 'App\Http\Controllers\Shop\CartController@addedToCart' ] );


    /*
    |--------------------------------------------------------------------------
    | Static site Routes
    |--------------------------------------------------------------------------
    |
    */

    get( '/', array( 'as' => 'home', 'uses' => 'App\Http\Controllers\HomeController@index' ) );