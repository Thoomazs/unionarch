@extends('admin.layouts.master')

@section('title')
    role index | @parent
@stop


@section('content')

        <div class="controls">
            <div class="row">
                <div class="col-sm-4 hidden-xs">
                        <a href="{{ route('admin.roles.create') }}" class="create btn btn-success">
                            <i class="fa fa-plus"></i>
                        </a>
                </div>
            </div>
        </div>


        <div class="table-responsive">
            <table class="table table-condensed table-bordered table-responsive table-striped table-hover no-margin-bottom">
                <thead>
                    <tr>
                        <th class="id">{{ trans('ID') }}</th>
                        <th>{{ trans('Name') }}</th>
                        <th>{{ trans('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>

                @if( count( $roles) > 0)

                    @foreach($roles as $role)
                        <tr>
                            <td class="id">
                                {{ $role->id }}
                            </td>
                            <td>
                                {{ $role->name }}
                            </td>
                            <td class="actions">
                                <a class="update btn btn-xs btn-default" href="{{ route('admin.roles.edit', [$role->id] ) }}" title="Edit">
                                    <i class="fa fa-pencil"></i>
                                </a>

                                <div class="inline-block" title="Delete">

                                    {!! Form::open(array('route' => ['admin.roles.destroy', $role->id ], 'method' => 'DELETE')) !!}

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
    </div>
</div>

@stop