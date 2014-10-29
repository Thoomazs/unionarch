<?php namespace App\Http\Controllers\User;

use App\Http\Controllers\BaseController;

/**
 * @Middleware("auth")
 */
class MyAccountController extends BaseController {

    /**
     * Show profile.
     *
     * @Get("profile", as="my-account.profile")
     *
     * @return Response
     */
    public function getProfile()
    {
        return view('site.users.profile');
    }

}
