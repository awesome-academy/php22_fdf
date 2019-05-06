@extends('layouts.app')
@section('content')
    <div class="card-header">
        @lang('header.product.col_trash')
    </div>
    <table class="table table-hover">
        <thead>
            <th>
                @lang('header.product.lb_image')
            </th>
            <th>
                @lang('header.users.header_name')
            </th>
            <th>
                @lang('header.category.col_category')
            </th>
            <th>
                @lang('header.product.col_price')
            </th>
            <th>
                @lang('header.product.col_quantity')
            </th>
            <th>
                @lang('header.category.col_edit')
            </th>
            <th>
                @lang('header.product.col_trash')
            </th>
        </thead>
        <tbody>
        @if ($products->count() > config('setting.default_value_0'))
            @foreach($products as $product)
                <tr>
                    <td>
                        <img src="{{ asset('storage/uploads/cover_images/'. $product->images[config('setting.default_value_0')]->url)}}" alt="{{ $product->name }}" class="image_product">
                    </td>
                    <td>
                        {{ $product->name }}
                    </td>
                    <td>
                        {{ $product->category->name }}
                    </td>
                    <td>
                        {{ $product->price }}
                    </td>
                    <td>
                        {{ $product->quantity }}
                    </td>
                    <td>
                        <a href="{{route('product.restore', ['id' => $product->id]) }}" class=" btn btn-primary">
                            @lang('header.product.col_restore')
                        </a>
                    </td>
                    <td>
                        @if ($index)
                            @include('admin.products.index')
                        @else
                            @include('admin.products.trashed')
                        @endif
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="4" class="text-center"> @lang('header.product.no_post')</td>
            </tr>
        @endif
        </tbody>
    </table>
    {{$products->links()}}
@endsection
