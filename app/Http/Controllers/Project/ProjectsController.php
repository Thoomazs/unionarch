<?php namespace App\Http\Controllers\Project;

use App\Http\Controllers\AdminController;

use App\Http\Repositories\CategoriesRepository;
use App\Http\Repositories\ProjectsRepository;

use App\Project;
use App\Category;

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
    public function index( Category $category, CategoriesRepository $categoriesRepository )
    {
        if( ! empty( $category->toArray()) )
        {
            $this->repository = $this->repository->category( $category );
        }

        $projects = $this->repository->paginate(18);

        $categories = $categoriesRepository->all();

        return view( 'site.projects.index', compact( 'projects', 'categories' ) );
    }


    public function show( Project $project, CategoriesRepository $categoriesRepository )
    {
        if ( !$project->id )
        {
            return redirect()->route( 'projects.index' );
        }

        $categories = $categoriesRepository->all();

        return view( 'site.projects.show', compact( 'project', 'categories' ) );
    }
}
