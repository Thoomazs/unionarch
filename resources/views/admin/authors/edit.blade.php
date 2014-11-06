@extends('admin.layouts.master')

@section('content')

<div class="row margin-top">
    <div class="col-sm-6 col-sm-offset-3">

        <div class="well">
            {!! Form::model($author, ['route' => ['admin.authors.update',$author->id], 'method' => 'PATCH']) !!}

            <fieldset>

                {!! Form::hidden('id', $author->id) !!}

                <legend>
                    #{{ $author->id }} {{ $author->name }}
                </legend>

                @include("admin.authors._form")

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
