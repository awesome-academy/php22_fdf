@extends('layouts.app')
@section('content')
    @include('admin.include.errors')
    <div class="card">
        <div class="card-header">
            <a href = "{{ route('admin.product.create') }}">@lang('header.product.title_create')</a>
        </div>
    </div>
    <div class="card-body">
        {!! Form::open(['method' => 'POST', 'route' => 'admin.product.store', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group" >
            {!! Form::label('name', @trans('header.users.header_name'), ['class' => 'col-sm-4 col-form-label ']) !!}
            {!! Form::text('name', ' ', [ 'class' => 'form-control' ]) !!}
        </div>

        <div class="form-group" >
            {!! Form::label('description', @trans('header.category.lb_description'), ['class' => 'col-sm-4 col-form-label']) !!}
            {!! Form::text('description', ' ', ['class' => 'form-control']) !!}
        </div>

        <div class="form-group" >
            {!! Form::label('image', @trans('header.product.lb_image'), ['class' => 'col-sm-4 col-form-label']) !!}
            {{Form::file('image[]', [ 'multiple' => true ])}}
        </div>

        <div class="form-group" >
            {!! Form::label('price', @trans('header.product.lb_price'), ['class' => 'col-sm-4 col-form-label']) !!}
            {!! Form::text('price', ' ', ['class' => 'form-control']) !!}
        </div>

        <div class="form-group" >
            {!! Form::label('discount', @trans('header.product.lb_discount'), ['class' => 'col-sm-4 col-form-label']) !!}
            {!! Form::selectRange('discount', config('setting.default_value_0'), config('setting.default_value_10'), ['class' => 'form-control']) !!}
        </div>

        <div class="form-group" >
            {!! Form::label('quantity', @trans('header.product.col_quantity'), ['class' => 'col-sm-4 col-form-label']) !!}
            {!! Form::selectRange('quantity', config('setting.default_value_0'), config('setting.default_value_10'), ['class' => 'form-control']) !!}
        </div>

        <div class="form-group" >
            {!! Form::label('categories', @trans('header.product.lb_select_category'), ['class' => 'col-sm-4 col-form-label']) !!}
            {!! Form::select('categories', $categories) !!}
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                {!! Form::submit (@trans('header.product.btn_store'), ['class' => 'btn btn-primary'])!!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
