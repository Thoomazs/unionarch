@extends('site.layouts.master')

@section('title')
    Project index | @parent
@stop


@section('content')
    <div id="projects">
        <div class="clearfix">
            <h2 class="pull-left"><a href="">Projects</a></h2>

            <ul class="categories pull-right">
                @foreach($categories as $c)
                    <li class="@if(Request::url() == route('projects.category.show', [$c->slug])) active @endif">
                        <a href="{{ route('projects.category.show', [$c->slug]) }}" class="box-link" data-hover="{{ $c->name }}">
                            <span>{{ $c->name }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <div>
            <h3>{{ $project->name }}</h3>
        </div>
    </div>
@stop