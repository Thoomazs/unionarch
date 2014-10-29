@extends('admin.layouts.master')

@section('content')

<div class="row margin-top">
    <div class="col-sm-6 col-sm-offset-3">
    <div class="well">

        {!! Form::model($product, ['route' => ['admin.products.update', $product->id], 'method' => 'PATCH',  'files' => true]) !!}

        <fieldset>

            {!! Form::hidden('id', $product->id) !!}

            <legend>
                #{{ $product->id }} {{ $product->name }}
            </legend>

            @include("admin.products._form")


            <!-- Edit Form Submit -->

            <div class="form-group">
                {!! Form::button(trans('Edit'), ['type' => 'submit', 'class' => 'btn btn-primary form-control']) !!}
            </div>


        </fieldset>

        {!! Form::close() !!}
        </div>
    </div>
</div>
@stop
