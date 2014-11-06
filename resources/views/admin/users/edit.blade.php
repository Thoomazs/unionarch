@extends('admin.layouts.master')

@section('content')

<div class="row margin-top">
    <div class="col-sm-6 col-sm-offset-3">

        <div class="well">
            {!! Form::model($user, ['route' => ['admin.users.update',$user->id], 'method' => 'PATCH']) !!}

            <fieldset>

                {!! Form::hidden('id', $user->id) !!}

                <legend>
                    #{{ $user->id }} {{ $user->name }}
                </legend>

                @include("admin.users._form")

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
