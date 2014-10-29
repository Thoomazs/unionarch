<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;

use App\Http\Repositories\UsersRepository;

use Illuminate\Http\Request;

use App\role;



/**
 * Class rolesController
 *
 * @Resource("admin/roles")
 * @Middleware("admin")
 *
 */
class RolesController extends AdminController
{

    /**
     * @var role
     */
    protected $repository;


    /**
     * @param role $role
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
    public function index()
    {

        $roles = $this->repository->roles();

        return view( 'admin.roles.index', compact( 'roles' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view( 'admin.roles.create' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store( Request $request )
    {

        $role = $this->repository->createRole( $request->all() );

        if ( is_null( $role ) )
        {
            return redirect()->back();
        }
        else
        {
            $this->flash( trans( 'Role #'.$role->id.' '.$role->name.' created.' ) );

            return redirect( route( "admin.roles.edit", [ $role->id ] ) );
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show( Role $role )
    {
        return redirect()->route( 'admin.roles.edit', [$role->id] );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit( Role $role )
    {
        if ( !$role->id )
        {
            return redirect()->route( 'admin.roles.index' );
        }

        return view( 'admin.roles.edit', compact( 'role' ) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function update( Request $request )
    {
        $this->repository->updateRole( $request->all() );

        return redirect()->route( "admin.roles.index" );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy( Request $request, Role $role )
    {


        if ( $this->repository->destroyRole( $role ) )
        {
            $this->flash( trans( 'Role #'.$role->id.' '.$role->name.' was deleted.' ));
        }
        else
        {
            $this->flash( trans( 'You can\'t delete this role.' ), 'msg-danger' );
        }

        return redirect( route( "admin.roles.index" ) );
    }
}
