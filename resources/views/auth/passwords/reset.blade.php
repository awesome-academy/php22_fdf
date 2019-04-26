@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">@lang('reset_password')</div>
                    <div class="card-body">
                        {!! Form::open(['route' => 'password.update', 'method' => 'POST']) !!}

                        <div class="form-group row">
                            {!! Form::label('email', trans('header.email'), ['class' => 'col-md-4 col-form-label text-md-right'] ) !!}

                            <div class="col-md-6">
                                {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
                                @include('common.error')
                            </div>
                        </div>

                        <div class="form-group row">
                            {!! Form::label('password', trans('header.password'), ['class' => 'col-md-4 col-form-label text-md-right'] ) !!}

                            <div class="col-md-6">
                                {!! Form::password('password', ['class' => 'form-control']) !!}
                                @include('common.error')
                            </div>
                        </div>

                        <div class="form-group row">
                            {!! Form::label('password-confirm"', trans('header.confirm_password'), ['class' => 'col-md-4 col-form-label text-md-right'] ) !!}
                            <div class="col-md-6">
                                {!! Form::password('password_confirmation', ['class' => 'form-control', 'id' => 'password-confirm']) !!}
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    @lang('header.reset_password')
                                </button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
