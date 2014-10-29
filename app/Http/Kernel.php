<?php namespace App\Http;

use Exception;
use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;

class Kernel extends HttpKernel
{

	/**
	 * The application's HTTP middleware stack.
	 *
	 * @var array
	 */
	protected $middleware = [
		'App\Http\Middleware\UnderMaintenance',
		'Illuminate\Cookie\Middleware\EncryptCookies',
		'Illuminate\Cookie\Middleware\AddQueuedCookiesToRequest',
		'Illuminate\Session\Middleware\ReadSession',
		'Illuminate\Session\Middleware\WriteSession',
		'Illuminate\View\Middleware\ShareErrorsFromSession',
		'App\Http\Middleware\VerifyCsrfToken',
	];

    /**
     * Handle an incoming HTTP request.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function handle( $request )
    {
        try
        {
            return parent::handle( $request );
        }
        catch ( Exception $e )
        {


            if ( !Config::get( 'app.debug' ) )
            {
                Log::error( $e );

                $code = $e->getStatusCode();

                switch ( $code )
                {
                    case 403:
                        return response( view( 'error.403' ), 403 );

                    case 404:
                        return response( view( 'error.404' ), 404 );

                    case 500:
                        return response( view( 'error.500' ), 500 );

                    default:
                        return response( view( 'error.default', compact( 'code' ) ), $code );
                }
            } else {
                throw $e;
            }
        }
    }

}
