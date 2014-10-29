<?php namespace App\Http\Controllers\User;

use App\Http\Controllers\BaseController;
use App\Http\Repositories\UserRepository;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * @Middleware("guest")
 */
class PasswordController extends BaseController
{

    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * Create a new password controller instance.
     *
     * @param  PasswordBroker $passwords
     *
     * @return void
     */
    public function __construct( UserRepository $repository )
    {
        parent::__construct();

        $this->repository = $repository;
    }

    /**
     * Display the form to request a password reset link.
     * @Get("forget-password", as="password.reset-request")
     *
     * @return Response
     */
    public function showResetRequestForm()
    {
        return view( 'site.users.password.reset-request' );
    }

    /**
     * Send a reset link to the given user.
     * @Post("forget-password")
     *
     * @param  Request $request
     *
     * @return Response
     */
    public function sendResetLink( Request $request )
    {
        $response = $this->repository->resetLink( $request->only( 'email' ) );

        if ( $response === true )
        {
            $this->flash( trans( 'passwords.sent' ) );

            return redirect()->route( "home" );
        }
        else
        {
            return redirect()->back()->withInput()->withErrors( $response );
        }
    }

    /**
     * Display the password reset view for the given token.
     * @Get("reset-password/{token}", as="password.reset.token")
     *
     * @param  string $token
     *
     * @return Response
     */
    public function showResetForm( $token = null )
    {
        if ( is_null( $token ) )
        {
            throw new NotFoundHttpException;
        }

        return view( 'site.users.password.reset' )->with( 'token', $token );
    }

    /**
     * Reset the given user's password.
     * @Post("reset-password", as="password.reset")
     *
     * @param  Request $request
     *
     * @return Response
     */
    public function resetPassword( Request $request )
    {

        $response = $this->repository->reset( $request->only( 'email', 'password', 'password_confirmation', 'token' ) );

        if ( $response === true )
        {
            $this->flash( trans( 'passwords.sent' ) );

            return redirect()->route( "home" );
        }
        else
        {
            return redirect()->back()->withInput()->withErrors( $response );
        }
    }

}
