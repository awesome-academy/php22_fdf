@extends('layouts.app')
@section('content')
    @include('admin.include.errors')
        <div class="card">
            <div class="card-header">
                <a href = "{{ route('admin.category.edit', ['id' => $category->id]) }}">@lang('header.category.title_edit')</a>
            </div>
        </div>
        <div class="card-body">
            {!! Form::open(['method' => 'PUT', 'route' => ['admin.category.update', 'id' => $category->id]]) !!}
                <div class="form-group" >
                    {!! Form::label('name', @trans('header.users.header_name'), ['class' => 'col-sm-4 col-form-label ']) !!}
                    {!! Form::text('name', $category->name, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group" >
                    {!! Form::label('description', @trans('header.category.lb_description'), ['class' => 'col-sm-4 col-form-label ']) !!}
                    {!! Form::text('description', $category->description, ['class' => 'form-control']) !!}
                </div>
                <div class="form-group" >
                    {!! Form::label('parent_id', @trans('header.category.col_parent'), ['class' => 'col-sm-4 col-form-label ']) !!}
                    {!! Form::select('parent_id', $categories->put(config('setting.default_value_0'), @trans('header.category.col_parent')), old('parent_id',  $category->parent_id), ['class' => 'form-control']) !!}
                </div>
                <div class="form-group row mb-0">
                     <div class="col-md-6 offset-md-4">
                          {!! Form::submit (@trans('header.category.btn_update'), ['class' => 'btn btn-primary'])!!}
                     </div>
                </div>
            {!! Form::close() !!}
        </div>
@endsection
