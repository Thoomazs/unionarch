@extends('site.layouts.master')

@section('content')

    {{-- TODO: quick fix --}}
        <?php $errors = Session::has('errors') ? Session::get('errors') : $errors; ?>


@if( Session::has('status')  )
{{ var_dump(Session::get('status')) }}
@endif

@if( Session::has('error')  )
{{ var_dump(Session::get('error')) }}
@endif
        <div class="col-sm-6 col-sm-offset-3">

            <div class="well">

                {!! Form::open(['route' => 'password.reset-request', 'method' => 'POST', 'autocomplete' => 'off', 'novalidate', 'class' => 'form-basic']) !!}
                    <fieldset>
                        <legend>{{ trans('Reset Password') }}</legend>

                        <!-- Email Form Input -->

                        <div class="form-group {{ $errors->has('email') ? 'has-error': '' }}">
                            {!! Form::label('email', trans('Email') . ':') !!}

                            {!! $errors->first('email', '<div class="form-error">:message</div>') !!}

                            {!! Form::email('email', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                        </div>

                      <!-- Login Form Submit -->

                      <div class="form-group">
                            {!! Form::button( trans('Request new password'), ['type' => 'submit', 'class' => 'btn btn-primary form-control']) !!}
                      </div>

                    </fieldset>
                {!! Form::close() !!}

            </div>
        </div>

@stop
