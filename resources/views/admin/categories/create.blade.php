@extends('layouts.app')
@section('content')
    @include('admin.include.errors')
        <div class="card">
            <div class="card-header">
                <a href = "{{ route('admin.category.create') }}">@lang('header.category.title_create')</a>
            </div>
        </div>
        <div class="card-body">
            {!! Form::open(['method' => 'POST', 'route' => 'admin.category.store']) !!}
                <div class="form-group" >
                    {!! Form::label('name', @trans('header.users.header_name'), ['class' => 'col-sm-4 col-form-label ']) !!}
                    {!! Form::text('name', ' ', ['class' => 'form-control']) !!}
                </div>
                <div class="form-group" >
                    {!! Form::label('description', @trans('header.category.lb_description'), ['class' => 'col-sm-4 col-form-label ']) !!}
                    {!! Form::text('description', ' ', ['class' => 'form-control']) !!}
                </div>
                <div class="form-group" >
                    {!! Form::label('parent_id', @trans('header.category.col_parent'), ['class' => 'col-sm-4 col-form-label ']) !!}
                    {{ Form::select('parent_id', $categories->put(config('setting.default_value_0'), @trans('header.category.col_parent')), old('parent_id', config('setting.default_value_0')), ['class' => 'form-control']) }}
                </div>
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                         {!! Form::submit ( @trans('header.category.btn_store'), ['class' => 'btn btn-primary'])!!}
                   </div>
                </div>
            {!! Form::close() !!}
        </div>
@endsection
