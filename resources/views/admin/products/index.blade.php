@extends('admin.layouts.master')

@section('title')
    Product index | @parent
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
                        <a href="{{ route('admin.products.create') }}" class="create btn btn-success">
                            <i class="fa fa-plus"></i>
                        </a>
                </div>
                <div class="col-sm-4">
                    <div class="pull-right">
                        @include("templates.pagination", ["paginator" => $products, "type" => "simple"])
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
                        <th>{{ trans('Stock') }}</th>
                        <th>{{ trans('Price') }}</th>
                        <th>{{ trans('Action') }}</th>
                    </tr>
                </thead>
                <tbody>

                @if( count( $products) > 0)

                    @foreach($products as $product)
                        <tr>
                            <td class="id">
                                {{ $product->id }}
                            </td>
                            <td>
                                {{ $product->name }}
                            </td>
                             <td>
                                {{ $product->slug }}
                            </td>
                            <td>
                                {{ $product->stock }} {{ trans('ks') }}
                            </td>
                             <td>
                                {{ $product->price }} {{ trans('Kč') }}
                            </td>
                            <td class="actions">
                                <a class="update btn btn-xs btn-default" href="{{ route('admin.products.edit', [$product->id] ) }}" title="Edit">
                                    <i class="fa fa-pencil"></i>
                                </a>

                                <div class="inline-block" title="Delete">

                                    {!! Form::open(array('route' => ['admin.products.destroy', $product->id ], 'method' => 'DELETE')) !!}

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

            @if( count( $products) > 0)
            <div class="controls overflow-hidden">
                <div class="pull-right">
                       @include("templates.pagination", ["paginator" => $products])
                </div>
            </div>
            @endif

    </div>
</div>

@stop