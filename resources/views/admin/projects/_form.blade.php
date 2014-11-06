
    <!-- Name Form Input -->

    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
        {!! Form::label('name', trans('Name') . ':') !!}

        {!! $errors->first('name', '<div class="form-error">:message</div>') !!}

        {!! Form::text('name', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
    </div>

    <!-- Client Form Input -->

    <div class="form-group {{ $errors->has('client') ? 'has-error' : '' }}">
        {!! Form::label('client', trans('Client') . ':') !!}

        {!! $errors->first('client', '<div class="form-error">:message</div>') !!}

        {!! Form::text('client', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
    </div>

    <!-- Desc Form Input -->

    <div class="form-group {{ $errors->has('desc') ? 'has-error' : '' }}">
        {!! Form::label('desc', trans('Desc') . ':') !!}

        {!! $errors->first('desc', '<div class="form-error">:message</div>') !!}

        {!! Form::textarea('desc', null, ['class' => 'form-control', 'autocomplete' => 'off', 'data-resize' => 'true']) !!}
    </div>

    <!-- Categories Form Select -->

    <div class="form-group {{ $errors->has('categories') ? 'has-error' : '' }}">
        {!! Form::label('categories', trans('Categories') . ':') !!}

        <div>
        <ul class="list-group hidden">

            @if(isset($project))
                @foreach($project->categories as $c)
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
    
    <!-- Authors Form Select -->
    
        <div class="form-group {{ $errors->has('authors') ? 'has-error' : '' }}">
            {!! Form::label('authors', trans('Authors') . ':') !!}
    
            <div>
            <ul class="list-group hidden">
    
                @if(isset($project))
                    @foreach($project->authors as $a)
                        <input type="hidden" name="authors[]" value="{{ $a->id }}"/>
                    @endforeach
                @endif
            </ul>
            <div class="form-select">
                {!! $errors->first('authors', '<div class="form-error">:message</div>') !!}
    
                {!! Form::select(null, [0 => trans('Vyberte možnost.')] + $authors, null, ['class'=>'form-control many-to-many','data-name' => 'authors', 'autocomplete' => 'off']) !!}
            </div>
            </div>
        </div>

    <hr/>
