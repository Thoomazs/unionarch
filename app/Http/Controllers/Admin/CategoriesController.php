<?php namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\AdminController;
use App\Http\Repositories\CategoriesRepository;
use App\Http\Repositories\ProductsRepository;
use App\Http\Requests\Category\CategoryRequest;
use Illuminate\Http\Request;

class CategoriesController extends AdminController
{

    protected $repository;

    function __construct( CategoriesRepository $repository )
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

        $categories = $this->repository->paginate();

        return view( 'admin.categories.index', compact( 'categories' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create( ProductsRepository $productsRepository )
    {
        $products = $productsRepository->optionArray();
        $categories = $this->repository->optionArray();

        return view( 'admin.categories.create', compact( 'products', 'categories' ) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store( CategoryRequest $request )
    {

        $category = $this->repository->create( $request->all() );

        if ( is_null( $category ) )
        {
            return redirect()->back();
        }
        else
        {
            $this->flash( trans( 'Category #'.$category->id.' '.$category->name.' created.' ) );

            return redirect( route( "admin.categories.edit", [ $category->id ] ) );
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show( Category $category )
    {
        return redirect()->route( 'admin.categories.edit', [ $category->id ] );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit( Category $category, ProductsRepository $productsRepository )
    {
        if ( !$category->id )
        {
            return redirect()->route( 'admin.categories.index' );
        }

        $products = $productsRepository->optionArray();
        $categories = $this->repository->optionArray();

        $categories = array_diff_key($categories,[$category->id => 'This category']);

        return view( 'admin.categories.edit', compact( 'category', 'products', 'categories' ) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function update( CategoryRequest $request )
    {
        $category = $this->repository->update( $request->all() );

        $this->flash( trans( 'Category #'.$category->id.' '.$category->name.' was updated.' ) );

        return redirect()->route( "admin.categories.index" );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy( Request $request, Category $category )
    {


        if ( $this->repository->destroy( $category ) )
        {
            $this->flash( trans( 'Category #'.$category->id.' '.$category->name.' was deleted.' ) );
        }
        else
        {
            $this->flash( trans( 'You can\'t delete this category.' ), 'msg-danger' );
        }

        return redirect( route( "admin.categories.index" ) );
    }

}
