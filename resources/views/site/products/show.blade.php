@extends('site.layouts.master')

@section('content')

<div class="col-xs-12">
    <div class="well">
        <div class="row">
            <div class="col-sm-6">
                <img class="img-responsive" src="{{ $product->photo }}" alt=""/>
            </div>
        <div class="col-sm-6">
            <h1>{{ $product->name }}</h1>
            <p>{{ $product->desc }}</p>
            <div class="well">
                {!! Form::open([ 'route' => 'cart.added-to-cart', 'method' => 'POST', 'autocomplete' => 'off', 'novalidate', 'class' => 'form-basic' ]) !!}
                    <fieldset>

                        <input type="hidden" name="id" value="{{ $product->id }}"/>

                        <!-- Quantity Form Input -->

                        <div class="form-group {{ $errors->has('quantity') ? 'has-error' : '' }}">
                            {!! Form::label('quantity', trans('Quantity') . ':') !!}

                            {!! Form::input('number', 'quantity', 1, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                        </div>


                        <span class="font-weight-bold text-success">
                             {{ $product->price . ' ' . trans('Kč')}}
                         </span>

                         <!-- Add to cart Form Submit -->

                         <div class="form-group">
                             {!! Form::button(trans('Add to cart'), ['type' => 'submit', 'class' => 'btn btn-success form-control']) !!}
                         </div>


                    </fieldset>
                {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>
@stop
