@extends('admin.layouts.master')

@section('content')

<div class="row margin-top">
    <div class="col-sm-6 col-sm-offset-3">

    <div class="well">
            {!! Form::model($category, ['route' => ['admin.categories.update',$category->id], 'method' => 'PATCH']) !!}

            <fieldset>

                {!! Form::hidden('id', $category->id) !!}

                <legend>
                    #{{ $category->id }} {{ $category->name }}
                </legend>

                @include("admin.categories._form")

                {!! Form::button( trans('Edit'), array('type' => 'submit', 'class' => 'btn btn-success btn-block')); !!}

            </fieldset>

            {!! Form::close() !!}
        </div>
    </div>
</div>
@stop
