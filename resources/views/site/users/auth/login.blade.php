@extends('site.layouts.master')

@section('content')

    <div class="col-sm-6 col-sm-offset-3">

        <div class="well">

            {!! Form::open(['route' => 'auth.login', 'method' => 'POST', 'autocomplete' => 'off', 'novalidate', 'class' => 'form-basic']) !!}
                <fieldset>
                    <legend>{{ trans('Login') }}</legend>

                    <!-- Email Form Input -->

                    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
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


                    <div class="row margin-bottom">
                        <div class="col-sm-6">

                            <!-- Remember Form Checkbox Input -->

                            <div class="form-group {{ $errors->has('remember') ? 'has-error' : '' }}">
                                {!! Form::label('remember', trans('Remember') . ':') !!}

                                <div class="checkbox">
                                    {!! Form::checkbox( 'remember', true, false, ['id' => 'remember']) !!}

                                    {!! $errors->first('remember', '<div class="form-error">:message</div>') !!}

                                    {!! Form::label('remember', trans('Remember')) !!}
                                </div>
                            </div>


                        </div>
                        <div class="col-sm-6">

                            <!-- Forget password -->

                            <a href="{{ route("password.reset-request") }}" class="pull-right btn btn-default btn-sm" style="margin-top: 27px;"> {{ trans("Forget password") }}</a>

                        </div>
                    </div>


                  <!-- Login Form Submit -->

                  <div class="form-group">
                      {!! Form::button(trans('Login'), ['type' => 'submit', 'class' => 'btn btn-primary form-control']) !!}
                  </div>


                </fieldset>
            {!! Form::close() !!}

        </div>
    </div>
@stop
