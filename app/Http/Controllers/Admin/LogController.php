<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use App\Http\Repositories\LogRepository;
use Illuminate\Http\Request;

/**
 * Class LogController
 *
 * @Resource("admin/log", only={"index"})
 * @Middleware("admin")
 *
 */
class LogController extends AdminController
{
    protected $repository;

    function __construct( LogRepository $log )
    {
        parent::__construct();

        $this->repository = $log;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index( Request $request )
    {
        if ( ( $s = $request->get( 's' ) ) )
        {
            $this->repository = $this->repository->search( $s );
        }

        $logs = $this->repository->paginate();

        return view( "admin.log.index", compact( 'logs' ) );
    }


}
