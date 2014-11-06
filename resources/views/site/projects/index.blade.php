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

<div class="clearfix">
    <div class="pull-right product-view">
        <a href="" class="active">
            <i class="fa fa-th fa-3x"></i>
        </a>
        <a href="">
            <i class="fa fa-th-list fa-3x"></i>
        </a>
    </div>
</div>
        <div class="row projects">
             @foreach($projects as $p)
                <div class="col-sm-2">
                <div class="project">
                    <a href="{{ route("projects.show", [$p->slug]) }}">
                        <img src="http://placehold.it/160x107" alt=""/>
                        <div class="name">
                            {{ $p->name }}
                        </div>
                    </a>
                </div>

                </div>
             @endforeach
         </div>
    </div>
@stop