<?php namespace App\Http\Controllers;

use App\Http\Controllers\BaseController;

/**
 * @Resource("admin", only={"index"}, names={"index": "admin"})
 * @Middleware("admin")
 *
 */
class AdminController extends BaseController
{

    function  __construct( )
    {
        parent::__construct( );
    }

    /**
     * @return \Illuminate\View\View
     */
    public function getDashboard()
    {

        return view( "admin.welcome" );
    }

    public function getSettings()
    {

        return view( "admin.settings" );
    }


}
