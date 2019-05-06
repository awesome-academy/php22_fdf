@extends('layouts.app')
@section('content')
    @include('admin.include.errors')
    <div class="card">
        <div class="card-header">
            <a href = "{{ route('admin.product.edit', ['id' => $product->id]) }}">@lang('header.product.title_create')</a>
        </div>
    </div>
    <div class="card-body">
        {!! Form::open(['method' => 'PUT','route' => ['admin.product.update', 'id' => $product->id],  'enctype' => 'multipart/form-data']) !!}
        <div class="form-group" >
            {!! Form::label('name', @trans('header.users.header_name'), ['class' => 'col-sm-4 col-form-label ']) !!}
            {!! Form::text('name', $product->name, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group" >
            {!! Form::label('description', @trans('header.category.lb_description'), ['class' => 'col-sm-4 col-form-label']) !!}
            {!! Form::text('description', $product->description, [ 'class' => 'form-control' ]) !!}
        </div>

        <div class="form-group" >
            {!! Form::label('image', @trans('header.product.lb_image'), ['class' => 'col-sm-1 col-form-label']) !!}
            @for($i = config('setting.default_value_0'); $i < count($product->images); $i++)
                <img src="{{asset('storage/uploads/cover_images/'. $product->images[$i]->url)}}" alt="{{$product->name}}" class="image_product_list">
            @endfor
        </div>

        <div class="form-group" >
            {!! Form::label('image', @trans('header.product.lb_image'), ['class' => 'col-sm-4 col-form-label']) !!}
            {!! Form::file('image[]', [ 'multiple' => true ])!!}
        </div>

        <div class="form-group" >
            {!! Form::label('price', @trans('header.product.lb_price'), ['class' => 'col-sm-4 col-form-label']) !!}
            {!! Form::text('price', $product->price, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group" >
            {!! Form::label('discount', @trans('header.product.lb_discount'), ['class' => 'col-sm-4 col-form-label']) !!}
            {!! Form::selectRange('discount', config('setting.default_value_0'), config('setting.default_value_10'), $product->discount, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group" >
            {!! Form::label('quantity', @trans('header.product.col_quantity'), ['class' => 'col-sm-4 col-form-label']) !!}
            {!! Form::selectRange('quantity', config('setting.default_value_0'), config('setting.default_value_10'), $product->quantity, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group" >
            {!! Form::label('categories', @trans('header.product.lb_select_category'), ['class' => 'col-sm-4 col-form-label']) !!}
            {!! Form::select('categories', $categories, $product->category_id) !!}
        </div>

        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                {!! Form::submit (@trans('header.product.btn_update'), ['class' => 'btn btn-primary'])!!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
