<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;

use App\Http\Requests\Author\AuthorRequest;
use Illuminate\Http\Request;

use App\Http\Repositories\ProjectsRepository;
use App\Http\Repositories\AuthorsRepository;
use App\Author;

class AuthorsController extends AdminController
{

    protected $repository;

    function __construct( AuthorsRepository $repository )
    {
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

        $authors = $this->repository->paginate();

        return view( 'admin.authors.index', compact( 'authors' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create( ProjectsRepository $projectRepository )
    {
        $projects = $projectRepository->optionArray();

        return view( 'admin.authors.create', compact( 'projects' ) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store( AuthorRequest $request )
    {
        $author = $this->repository->create( $request->all() );

        if ( is_null( $author ) )
        {
            return redirect()->back();
        }
        else
        {
            $this->flash( trans( 'Author #'.$author->id.' '.$author->name.' created.' ) );

            return redirect( route( "admin.authors" ) );
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show( Author $author )
    {
        return redirect()->route( 'admin.authors.edit', [ $author->id ] );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit( Author $author, ProjectsRepository $projectRepository )
    {
        if ( !$author->id )
        {
            return redirect()->route( 'admin.authors.index' );
        }

        $projects = $projectRepository->optionArray();

        return view( 'admin.authors.edit', compact( 'author', 'projects') );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function update( AuthorRequest $request )
    {


        $author = $this->repository->update( $request->all() );

        $this->flash( trans( 'Author #'.$author->id.' '.$author->name.' was updated.' ) );

        return redirect()->route( "admin.authors.index" );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy( Request $request, Author $author )
    {


        if ( $this->repository->destroy( $author ) )
        {
            $this->flash( trans( 'Author #'.$author->id.' '.$author->name.' was deleted.' ) );
        }
        else
        {
            $this->flash( trans( 'You can\'t delete this author.' ), 'msg-danger' );
        }

        return redirect( route( "admin.authors.index" ) );
    }

}
