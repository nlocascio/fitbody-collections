@extends('layout')

@section('content')
    {!! Form::open(['url' => route('auth.login'), 'class' => 'form-horizontal']) !!}
        <div class="form-group">
            {!! Form::label('username', 'Username', ['class' => 'col-sm-2 control-label']) !!}
            <div class="col-sm-10">
                {!! Form::text('username', old('username'), ['class' => 'form-control', 'type' => 'username', 'placeholder' => 'Username']) !!}
            </div>
        </div>

        <div class="form-group">
            {!! Form::label('password', 'Password', ['class' => 'col-sm-2 control-label']) !!}

            <div class="col-sm-10">
                {!! Form::password('password', ['class' => 'form-control', 'type' => 'password', 'placeholder' => 'Password']) !!}
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <div class="checkbox">
                    <label>
                        {!! Form::checkbox('remember','remember')  !!}
                        Remember me
                    </label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                {!! Form::submit('Log In', ['class' => 'btn btn-default']) !!}
            </div>
        </div>
    {!! Form::close() !!}
@endsection