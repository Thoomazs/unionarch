@extends('site.layouts.master')

@section('content')

    <h2><a href="">Index</a></h2>

{{ var_dump(Session::get('errors')) }}
{{ var_dump(Session::get('inputs')) }}

    {!! Form::open(['method' => 'POST', 'autocomplete' => 'off', 'novalidate', 'class' => 'form-basic' ]) !!}
        <fieldset>
            <legend></legend>

                 <input type="text" name="name"/>
                        <button type="submit">ok</button>

        </fieldset>
    {!! Form::close() !!}

@stop
