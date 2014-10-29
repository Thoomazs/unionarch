
    <!-- Name Form Input -->

    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
        {!! Form::label('name', trans('Name') . ':') !!}

        {!! $errors->first('name', '<div class="form-error">:message</div>') !!}

        {!! Form::text('name', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
    </div>

    <!-- Image Form Input -->

    <div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
        {!! Form::label('image', trans('Image') . ':') !!}

        {!! $errors->first('image', '<div class="form-error">:message</div>') !!}

        <div class="form-file">
            @if(isset($product))
                <a href="{{ $product->photo }}" data-popup='true'>
                    <img src="{{ $product->photo }}"/>
                </a>
            @endif
            <span class="text" data-title="{{ trans('vyberte soubor') }}">{{ trans('vyberte soubor') }}</span>
            {!! Form::file('image', ['class' => 'form-control', 'autocomplete' => 'off']) !!}
        </div>

    </div>


    <!-- Desc Form Input -->

    <div class="form-group {{ $errors->has('desc') ? 'has-error' : '' }}">
        {!! Form::label('desc', trans('Description') . ':') !!}

        {!! $errors->first('desc', '<div class="form-error">:message</div>') !!}

        {!! Form::textarea('desc', null, ['class' => 'form-control', 'rows' => 3, 'autocomplete' => 'off', 'data-resize' => 'true']) !!}
    </div>

    <!-- Stock Form Input -->

    <div class="form-group {{ $errors->has('stock') ? 'has-error' : '' }}">
        {!! Form::label('stock', trans('Stock') . ':') !!}

        {!! $errors->first('stock', '<div class="form-error">:message</div>') !!}

        {!! Form::input('number', 'stock', null, ['class' => 'form-control', 'min' => 0, 'autocomplete' => 'off']) !!}
    </div>

    <!-- Price Form Price Input -->

    <div class="form-group {{ $errors->has('price') ? 'has-error' : '' }}">
        {!! Form::label('price', trans('Price') . ':') !!}

        {!! $errors->first('price', '<div class="form-error">:message</div>') !!}

        {!! Form::input('number', 'price', null, ['class' => 'form-control', 'min' => 0, 'autocomplete' => 'off']) !!}
    </div>

    <!-- Categories Form Select -->

    <div class="form-group {{ $errors->has('categories') ? 'has-error' : '' }}">
        {!! Form::label('categories', trans('Categories') . ':') !!}

        <div>
        <ul class="list-group hidden">

            @if(isset($product))
                @foreach($product->categories as $c)
                    <input type="hidden" name="categories[]" value="{{ $c->id }}"/>
                @endforeach
            @endif
        </ul>
        <div class="form-select">
            {!! $errors->first('categories', '<div class="form-error">:message</div>') !!}

            {!! Form::select(null, [0 => trans('Vyberte možnost.')] + $categories, null, ['class'=>'form-control many-to-many','data-name' => 'categories', 'autocomplete' => 'off']) !!}
        </div>
        </div>
    </div>

    <hr/>
