@extends('site.layouts.master')

@section('content')

    <div class="col-xs-12">
        <div class="page-header">
            <h1>Products</h1>
        </div>
    </div>

    @foreach($products as $product)
         @include("templates.product-box")
    @endforeach

@stop
