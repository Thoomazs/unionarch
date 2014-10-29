
    <!-- Firstname Form Input -->

    <div class="form-group {{ $errors->has('firstname') ? 'has-error' : '' }}">
        {!! Form::label('firstname', trans('Firstname') . ':') !!}

        {!! $errors->first('firstname', '<div class="form-error">:message</div>') !!}

        {!! Form::text('firstname', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
    </div>

    <!-- Lastname Form Input -->

    <div class="form-group {{ $errors->has('lastname') ? 'has-error' : '' }}">
        {!! Form::label('lastname', trans('Lastname') . ':') !!}

        {!! $errors->first('lastname', '<div class="form-error">:message</div>') !!}

        {!! Form::text('lastname', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
    </div>

    <!-- Email Form Input -->

    <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
        {!! Form::label('email', trans('Email') . ':') !!}

        {!! $errors->first('email', '<div class="form-error">:message</div>') !!}

        {!! Form::email('email', null, ['class' => 'form-control', 'autocomplete' => 'off']) !!}
    </div>

    <!-- Password Form Password Input -->

    <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
        {!! Form::label('password', trans('Password') . ':') !!}

        {!! $errors->first('password', '<div class="form-error">:message</div>') !!}

        {!! Form::password('password', ['class' => 'form-control', 'autocomplete' => 'off']) !!}
    </div>

    <!-- Password_confirmation Form Password Input -->

    <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
        {!! Form::label('password_confirmation', trans('Password_confirmation') . ':') !!}

        {!! $errors->first('password_confirmation', '<div class="form-error">:message</div>') !!}

        {!! Form::password('password_confirmation', ['class' => 'form-control', 'autocomplete' => 'off']) !!}
    </div>

    <hr/>
