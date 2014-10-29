<?php namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;

class BaseController extends Controller
{

    function  __construct()
    {

    }


    protected function flash($msg, $class = 'msg-success')
    {
        Session::flash( $class, $msg );
    }
}