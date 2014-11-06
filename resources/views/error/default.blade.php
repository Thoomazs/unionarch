@extends('site.layouts.master')

@section('content')


<div id="error" class="error-{{ $code }} col-xs-12">
    <h1>
        {{ $code }}
        <small class="muted font-weight-light">/ Server Error</small>
    </h1>

    <i class="fa-bg fa fa-globe"></i>
</div>

@stop