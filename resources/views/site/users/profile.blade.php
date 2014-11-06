@extends('site.layouts.master')

@section('content')

    <h1>{{ Auth::user()->name }}</h1>
@stop
