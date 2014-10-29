
    <!-- Name Form Input -->

    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
        {!! Form::label('name', trans('Name') . ':') !!}

        {!! $errors->first('name', '<div class="form-error">:message</div>') !!}

        {!! Form::text('name', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
    </div>

    <!-- Desc Form Input -->

    <div class="form-group {{ $errors->has('desc') ? 'has-error' : '' }}">
        {!! Form::label('desc', trans('Description') . ':') !!}

        {!! $errors->first('desc', '<div class="form-error">:message</div>') !!}

        {!! Form::textarea('desc', null, ['class' => 'form-control', 'rows' => 3, 'autocomplete' => 'off', 'data-resize' => 'true']) !!}
    </div>

    <!-- Superior Form Select -->

    <div class="form-group {{ $errors->has('superior_id') ? 'has-error' : '' }}">
        {!! Form::label('superior', trans('Superior') . ':') !!}

        <div class="form-select">
            {!! $errors->first('superior_id', '<div class="form-error">:message</div>') !!}

            {!! Form::select('superior_id', [0 => trans('Vyberte možnost.')] + $categories, null, ['class'=>'form-control','autocomplete' => 'off']) !!}
        </div>
    </div>


    <!-- Products Form Select -->

    <div class="form-group {{ $errors->has('products') ? 'has-error' : '' }}">
        {!! Form::label('products', trans('Products') . ':') !!}

        <div>
        <ul class="list-group hidden">

            @if(isset($category))
                @foreach($category->products as $c)
                    <input type="hidden" name="products[]" value="{{ $c->id }}"/>
                @endforeach
            @endif
        </ul>
        <div class="form-select">
            {!! $errors->first('products', '<div class="form-error">:message</div>') !!}

            {!! Form::select(null, [null => trans('Vyberte možnost.')] + $products, null, ['class'=>'form-control many-to-many','data-name' => 'products', 'autocomplete' => 'off']) !!}
        </div>
        </div>
    </div>
