<?php namespace App\Http\Controllers;

use App\Http\Requests\IndexRequest;

class HomeController extends BaseController
{

    /*
    |--------------------------------------------------------------------------
    | Default Home Controller
    |--------------------------------------------------------------------------
    |
    | You may wish to use controllers instead of, or in addition to, Closure
    | based routes. That's great! Here is an example controller method to
    | get you started. To route to this controller, just add the route:
    |
    |	Route::get('/', 'HomeController@index');
    |
    */

    /**
     *
     * @Get("/", as="home")
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {

        return view( 'site.pages.homepage' );
    }

}
