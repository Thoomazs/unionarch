<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;

use App\Http\Repositories\UsersRepository;
use App\User;

use Illuminate\Http\Request;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\DestroyUserRequest;
use App\Http\Requests\User\UpdateUserRequest;

/**
 * Class UsersController
 *
 * @Resource("admin/users")
 * @Middleware("admin")
 *
 */
class UsersController extends AdminController
{

    /**
     * @var User
     */
    protected $repository;


    /**
     * @param User $user
     */
    function __construct( UsersRepository $repository )
    {
        parent::__construct();

        $this->repository = $repository;
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

        $users = $this->repository->paginate();

        return view( 'admin.users.index', compact( 'users' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view( 'admin.users.create' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store( CreateUserRequest $request )
    {

        $user = $this->repository->create( $request->all() );

        if ( is_null( $user ) )
        {
            return redirect()->back();
        }
        else
        {
            $this->flash( trans( 'User #'.$user->id.' '.$user->name.' created.' ) );

            return redirect( route( "admin.users.edit", [ $user->id ] ) );
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show( User $user )
    {
        return redirect()->route( 'admin.users.edit', [$user->id] );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit( User $user )
    {
        if ( !$user->id )
        {
            return redirect()->route( 'admin.users.index' );
        }

        return view( 'admin.users.edit', compact( 'user' ) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function update( UpdateUserRequest $request )
    {
        $user = $this->repository->update( $request->all() );

        $this->flash( trans( 'User #'.$user->id.' '.$user->name.' was updated.' ));

        return redirect()->route( "admin.users.index" );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy( DestroyUserRequest $request, User $user )
    {


        if ( $this->repository->destroy( $user ) )
        {
            $this->flash( trans( 'User #'.$user->id.' '.$user->name.' was deleted.' ));
        }
        else
        {
            $this->flash( trans( 'You can\'t delete this user.' ), 'msg-danger' );
        }

        return redirect( route( "admin.users.index" ) );
    }
}
