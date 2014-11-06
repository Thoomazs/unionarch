
    <!-- Name Form Input -->

    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
        {!! Form::label('name', trans('Name') . ':') !!}

        {!! $errors->first('name', '<div class="form-error">:message</div>') !!}

        {!! Form::text('name', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
    </div>


    <!-- Order Form Input -->

    <div class="form-group {{ $errors->has('order') ? 'has-error' : '' }}">
        {!! Form::label('order', trans('Order') . ':') !!}

        {!! $errors->first('order', '<div class="form-error">:message</div>') !!}

        {!! Form::input('number', 'order', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
    </div>



    <!-- Projects Form Select -->

    <div class="form-group {{ $errors->has('projects') ? 'has-error' : '' }}">
        {!! Form::label('projects', trans('Projects') . ':') !!}

        <div>
        <ul class="list-group hidden">

            @if(isset($category))
                @foreach($category->projects as $c)
                    <input type="hidden" name="projects[]" value="{{ $c->id }}"/>
                @endforeach
            @endif
        </ul>
        <div class="form-select">
            {!! $errors->first('projects', '<div class="form-error">:message</div>') !!}

            {!! Form::select(null, [null => trans('Vyberte možnost.')] + $projects, null, ['class'=>'form-control many-to-many','data-name' => 'projects', 'autocomplete' => 'off']) !!}
        </div>
        </div>
    </div>
