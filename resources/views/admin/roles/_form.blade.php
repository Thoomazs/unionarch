
    <!-- Name Form Input -->

    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
        {!! Form::label('name', trans('Name') .':') !!}

        {!! $errors->first('name', '<div class="form-error">:message</div>') !!}

        {!! Form::text('name', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
    </div>

    <hr/>


