<?php namespace App\Http\Controllers\User;

use App\Http\Controllers\BaseController;
use App\Http\Repositories\UsersRepository;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;

/**
 * @Middleware("guest", except={"logout"})
 */
class AuthController extends BaseController
{

    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * @param UserRepository $repository
     */
    public function __construct( UsersRepository $repository )
    {
        $this->repository = $repository;
    }

    /**
     * Show the application registration form.
     * @Get("register", as="auth.register")
     *
     * @return Response
     */
    public function showRegistrationForm()
    {
        return view( 'site.users.auth.register' );
    }

    /**
     * Handle a registration request for the application.
     * @Post("register")
     *
     * @param  RegisterRequest $request
     *
     * @return Response
     */
    public function register( RegisterRequest $request )
    {
        $this->repository->login( $this->repository->create( $request->all() ) );

        return redirect()->route( "home" );
    }

    /**
     * Show the application login form.
     * @Get("login", as="auth.login")
     *
     * @return Response
     */
    public function showLoginForm()
    {
        return view( 'site.users.auth.login' );
    }

    /**
     * Handle a login request to the application.
     * @Post("login")
     *
     * @param  LoginRequest $request
     *
     * @return Response
     */
    public function login( LoginRequest $request )
    {
        $response = $this->repository->login( $request->only( 'email', 'password' ), $request->get( "remember" ) );

        if ( $response === true )
        {
            return redirect()->intended( route( 'home' ) );
        }
        else
        {
            return redirect()->route( 'auth.login' )->withErrors( $response );
        }
    }

    /**
     * Log the user out of the application.
     * @Get("logout", as="auth.logout")
     *
     * @return Response
     */
    public function logout()
    {
        $this->repository->logout();

        return redirect( '/' );
    }

}
