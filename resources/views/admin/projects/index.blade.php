@extends('admin.layouts.master')

@section('title')
    Project index | @parent
@stop


@section('content')

        <div class="controls">
            <div class="row">
                <div class="col-sm-4">
                    {!! Form::open(['method' => 'GET']) !!}
                    <div class="input-group">
                        {!! Form::text('s', Input::get('s'), [ 'class' => 'form-control', 'autofocus' => 'true' ] ) !!}

                        <span class="input-group-btn">
                            {!! Form::submit('Search', [ 'class' => 'btn btn-success pull-right' ]) !!}
                        </span>
                    </div>
                    {!! Form::close() !!}
                </div>

                <div class="col-sm-4 hidden-xs">
                        <a href="{{ route('admin.projects.create') }}" class="create btn btn-success">
                            <i class="fa fa-plus"></i>
                        </a>
                </div>
                <div class="col-sm-4">
                    <div class="pull-right">
                        @include("templates.pagination", ["paginator" => $projects, "type" => "simple"])
                    </div>
                </div>
            </div>
        </div>


        <div class="table-responsive">
            <table class="table table-condensed table-bordered table-responsive table-striped table-hover no-margin-bottom">
                <thead>
                    <tr>
                        <th class="id">{{ trans('ID') }}</th>
                        <th>{{ trans('Name') }}</th>
                        <th>{{ trans('Slug') }}</th>
                        <th>{{ trans('Categories') }}</th>
                        {{--<th>{{ trans('Authors') }}</th>--}}
                        <th>{{ trans('Action') }}</th>
                    </tr>
                </thead>
                <tbody>

                @if( count( $projects) > 0)

                    @foreach($projects as $project)
                        <tr>
                            <td class="id">
                                {{ $project->id }}
                            </td>
                            <td>
                                {{ $project->name }}
                            </td>
                             <td>
                                {{ $project->slug }}
                            </td>
                            <td>
                                @foreach( $project->categories as $c )
                                    {{ $c->name }},
                                @endforeach
                            </td>
                             {{--<td>--}}
                              {{--@foreach( $project->authors as $a )--}}
                                 {{--{{ $a->name }},--}}
                             {{--@endforeach--}}
                            {{--</td>--}}
                            <td class="actions">
                                <a class="update btn btn-xs btn-primary" href="{{ route('projects.show', [$project->slug] ) }}" title="Show" target="_blank">
                                    <i class="fa fa-file"></i>
                                </a>

                                <a class="update btn btn-xs btn-default" href="{{ route('admin.projects.edit', [$project->id] ) }}" title="Edit">
                                    <i class="fa fa-pencil"></i>
                                </a>

                                <div class="inline-block" title="Delete">

                                    {!! Form::open(array('route' => ['admin.projects.destroy', $project->id ], 'method' => 'DELETE')) !!}

                                        {!! Form::button( '<i class="fa fa-times"></i>', ['type' => 'submit', 'class' => 'btn btn-xs btn-danger', 'data-warning' => 'true']); !!}

                                    {!! Form::close() !!}

                                </div>
                            </td>
                        </tr>
                    @endforeach

                @else
                <tr>
                    <td colspan="99" class="end">
                       {{ trans('No records were found') }}
                    </td>
                </tr>
                @endif

                </tbody>
            </table>

            @if( count( $projects) > 0)
            <div class="controls overflow-hidden">
                <div class="pull-right">
                       @include("templates.pagination", ["paginator" => $projects])
                </div>
            </div>
            @endif

    </div>
</div>

@stop