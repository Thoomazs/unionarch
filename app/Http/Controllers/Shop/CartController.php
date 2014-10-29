<?php namespace App\Http\Controllers\Shop;

use App\Http\Controllers\BaseController;

use App\Http\Repositories\ProductsRepository;
use App\Product;

class CartController extends BaseController {

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
	public function addedToCart()
	{
        $products = $this->repository->all();

		return view('site.products.index', compact('products') );
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Product $product)
	{
        return view('site.products.show', compact('product') );
	}

}
