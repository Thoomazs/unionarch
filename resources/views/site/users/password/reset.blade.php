@extends('site.layouts.master')

@section('content')

        {{--{{ dd($errors) }}--}}

        <div class="col-sm-6 col-sm-offset-3">

            <div class="well">

                {!! Form::open(['route' => 'password.reset', 'method' => 'POST', 'autocomplete' => 'off', 'novalidate', 'class' => 'form-basic']) !!}
                    <fieldset>
                        <legend>{{ trans('Reset Password') }}</legend>


                           <input type="hidden" name="token" value="{{ $token }}"/>

                            <!-- Email Form Input -->

                            <div class="form-group {{ isset($errors) && $errors->has('email') ? 'has-error' : '' }}">
                                {!! Form::label('email', trans('Email') . ':') !!}

                                {!! $errors->first('email', '<div class="form-error">:message</div>') !!}

                                {!! Form::email('email', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                            </div>

                            <!-- Password Form Password Input -->

                            <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                                {!! Form::label('password', trans('Password') . ':') !!}

                                {!! $errors->first('password', '<div class="form-error">:message</div>') !!}

                                {!! Form::password('password', ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                            </div>

                            <!-- Password_confirmation Form Password Input -->

                            <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                                {!! Form::label('password_confirmation', trans('Password_confirmation') . ':') !!}

                                {!! $errors->first('password_confirmation', '<div class="form-error">:message</div>') !!}

                                {!! Form::password('password_confirmation', ['class' => 'form-control', 'autocomplete' => 'off']) !!}
                            </div>

                            <!-- Reset Password Form Submit -->

                            <div class="form-group">
                                {!! Form::button(trans('Reset Password'), ['type' => 'submit', 'class' => 'btn btn-primary form-control']) !!}
                            </div>

                    </fieldset>
                {!! Form::close() !!}

            </div>
        </div>


@stop
