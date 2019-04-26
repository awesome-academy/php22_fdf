@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"> @lang('header.login') </div>

                    <div class="card-body">
                        {!! Form::open(['route' => 'login', 'method' => 'POST']) !!}
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
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    {!! Form::checkbox('remember', old('remember') ? 'checked' : '', ['class' => 'form-check-input', 'id' => 'remember']) !!}
                                    {!! Form::label('remember', trans('header.remember-me')) !!}
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                {!! Form::submit (trans('header.login'), ['class' => 'btn btn-primary'])!!}
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        @lang('message.forgot_password')
                                    </a>
                                @endif
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
