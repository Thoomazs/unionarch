@extends('admin.layouts.master')

@section('content')

<div class="row margin-top">
    <div class="col-sm-6 col-sm-offset-3">
    <div class="well">

        {!! Form::model($project, ['route' => ['admin.projects.update', $project->id], 'method' => 'PATCH',  'files' => true]) !!}

        <fieldset>

            {!! Form::hidden('id', $project->id) !!}

            <legend>
                #{{ $project->id }} {{ $project->name }}
            </legend>

            @include("admin.projects._form")


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
