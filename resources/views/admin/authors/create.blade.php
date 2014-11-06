@extends('admin.layouts.master')

@section('content')

<div class="row margin-top">
    <div class="col-sm-6 col-sm-offset-3">

        <div class="well">
            {!! Form::open([ 'route' => 'admin.authors.store', 'method' => 'POST', 'autocomplete' => 'off', 'novalidate', 'class' => 'form-basic' ]) !!}
                <fieldset>
                    <legend>{{ trans('New author') }}</legend>

                    @include('admin.authors._form')

                    <!-- Store Form Submit -->

                    <div class="form-group">
                        {!! Form::button(trans('Store'), ['type' => 'submit', 'class' => 'btn btn-primary form-control']) !!}
                    </div>



                </fieldset>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@stop
