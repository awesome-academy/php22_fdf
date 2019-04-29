@extends('layouts.app')
@section('content')
    @include('admin.include.errors')
        <div class="card">
            <div class="card-header">
                <a href = "{{ route('admin.user.create') }}">@lang('header.users.title_new_user')</a>
            </div>
        </div>
        <div class="card-body">
            {!! Form::open(['method' => 'POST', 'route' => 'admin.user.store']) !!}
            <div class="form-group" >
                {!! Form::label('name', @trans('header.users.header_name'), ['class' => 'col-sm-4 col-form-label ']) !!}
                {!! Form::text('name', ' ', ['class' => 'form-control']) !!}
            </div>

            <div class="form-group" >
                {!! Form::label('email', @trans('header.email'), ['class' => 'col-sm-4 col-form-label ']) !!}
                {!! Form::text('email', ' ', ['class' => 'form-control']) !!}
            </div>

            <div class="form-group" >
                {!! Form::label('password', @trans('header.password'), ['class' => 'col-sm-4 col-form-label ']) !!}
                {!! Form::password('password', ['class' => 'form-control']) !!}
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    {!! Form::submit (@trans('header.users.btn_store'), ['class' => 'btn btn-primary'])!!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
@endsection
