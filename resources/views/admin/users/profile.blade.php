@extends('layouts.app')
@section('content')
    @include('admin.include.errors')
        <div class="card">
            <div class="card-header">
                <a href = "{{ route('admin.user.edit', ['id' => $user->id]) }}">@lang('header.users.title_profile')</a>
            </div>
        </div>
        <div class="card-body">
            {!! Form::open(['method' => 'PUT', 'route' => ['admin.user.update', 'id' => $user->id]]) !!}
                <div class="form-group" >
                    {!! Form::label('name', @trans('header.users.header_name'), ['class' => 'col-sm-4 col-form-label ']) !!}
                    {!! Form::text('name', $user->name, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group" >
                    {!! Form::label('email', @trans('header.email'), ['class' => 'col-sm-4 col-form-label ']) !!}
                    {!! Form::text('email', $user->email, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group" >
                    {!! Form::label('newpassword', @trans('header.new_pass'), ['class' => 'col-sm-4 col-form-label ']) !!}
                    {!! Form::password('newpassword', ['class' => 'form-control']) !!}
                </div>
                <div class="form-group" >
                    {!! Form::label('phone', @trans('header.phone'), ['class' => 'col-sm-4 col-form-label ']) !!}
                    {!! Form::text('phone', $user->phone, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group" >
                    {!! Form::label('address', @trans('header.address'), ['class' => 'col-sm-4 col-form-label ']) !!}
                    {!! Form::text('address', $user->address, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        {!! Form::submit (@trans('header.users.btn_update'), ['class' => 'btn btn-primary'])!!}
                    </div>
                </div>
                {!! Form::close() !!}
        </div>
@endsection
