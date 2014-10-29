<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;

use App\Http\Requests\Product\ProductRequest;
use Illuminate\Http\Request;

use App\Http\Repositories\CategoriesRepository;
use App\Http\Repositories\ProductsRepository;
use App\Product;

class ProductsController extends AdminController
{

    protected $repository;

    function __construct( ProductsRepository $repository )
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

        $products = $this->repository->paginate();

        return view( 'admin.products.index', compact( 'products' ) );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create( CategoriesRepository $categoriesRepository )
    {
        $categories = $categoriesRepository->optionArray();

        return view( 'admin.products.create', compact( 'categories' ) );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store( ProductRequest $request )
    {
        $product = $this->repository->create( $request->all() );

        if ( is_null( $product ) )
        {
            return redirect()->back();
        }
        else
        {
            $this->flash( trans( 'Product #'.$product->id.' '.$product->name.' created.' ) );

            return redirect( route( "admin.products.edit", [ $product->id ] ) );
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show( Product $product )
    {
        return redirect()->route( 'admin.products.edit', [ $product->id ] );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit( Product $product, CategoriesRepository $categoriesRepository )
    {
        if ( !$product->id )
        {
            return redirect()->route( 'admin.products.index' );
        }

        $categories = $categoriesRepository->optionArray();

        return view( 'admin.products.edit', compact( 'product', 'categories' ) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function update( ProductRequest $request )
    {


        $product = $this->repository->update( $request->all() );

        $this->flash( trans( 'Product #'.$product->id.' '.$product->name.' was updated.' ) );

        return redirect()->route( "admin.products.index" );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy( Request $request, Product $product )
    {


        if ( $this->repository->destroy( $product ) )
        {
            $this->flash( trans( 'Product #'.$product->id.' '.$product->name.' was deleted.' ) );
        }
        else
        {
            $this->flash( trans( 'You can\'t delete this product.' ), 'msg-danger' );
        }

        return redirect( route( "admin.products.index" ) );
    }

}
