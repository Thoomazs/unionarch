<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;

use App\Http\Requests\Project\ProjectRequest;
use Illuminate\Http\Request;

use App\Http\Repositories\CategoriesRepository;
use App\Http\Repositories\AuthorsRepository;
use App\Http\Repositories\ProjectsRepository;
use App\Project;

class ProjectsController extends AdminController
{

    protected $repository;

    function __construct( ProjectsRepository $repository )
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
            if(is_numeric($s)) {
                if( ( $product = Project::find($s) ) )  return redirect()->route( 'admin.projects.edit', [ $s ] );
            }

            $this->repository = $this->repository->search( $s );
        }

        $projects = $this->repository->paginate();

        return view( 'admin.projects.index', compact( 'projects' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create( CategoriesRepository $categoriesRepository, AuthorsRepository $authorsRepository )
    {
        $categories = $categoriesRepository->optionArray();
        $authors = $authorsRepository->optionArray();

        return view( 'admin.projects.create', compact( 'categories', 'authors' ) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store( ProjectRequest $request )
    {
        $project = $this->repository->create( $request->all() );

        if ( is_null( $project ) )
        {
            return redirect()->back();
        }
        else
        {
            $this->flash( trans( 'Project #'.$project->id.' '.$project->name.' created.' ) );

            return redirect( route( "admin.projects.index" ) );
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show( Project $project )
    {
        return redirect()->route( 'admin.projects.edit', [ $project->id ] );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit( Project $project, CategoriesRepository $categoriesRepository, AuthorsRepository $authorsRepository )
    {
        if ( !$project->id )
        {
            return redirect()->route( 'admin.projects.index' );
        }

        $categories = $categoriesRepository->optionArray();
        $authors = $authorsRepository->optionArray();

        return view( 'admin.projects.edit', compact( 'project', 'categories', 'authors' ) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function update( ProjectRequest $request )
    {


        $project = $this->repository->update( $request->all() );

        $this->flash( trans( 'Project #'.$project->id.' '.$project->name.' was updated.' ) );

        return redirect()->route( "admin.projects.index" );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy( Request $request, Project $project )
    {


        if ( $this->repository->destroy( $project ) )
        {
            $this->flash( trans( 'Project #'.$project->id.' '.$project->name.' was deleted.' ) );
        }
        else
        {
            $this->flash( trans( 'You can\'t delete this project.' ), 'msg-danger' );
        }

        return redirect( route( "admin.projects.index" ) );
    }

}
