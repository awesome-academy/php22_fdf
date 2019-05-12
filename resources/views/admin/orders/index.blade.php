@extends('layouts.app')
@section('content')
    @include('admin.include.errors')
    <div class="card">
        <div class="card-header">
            <a href = "">@lang('header.title.order')</a>
        </div>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">@lang('header.order.id')</th>
            <th scope="col">@lang('header.order.user_name')</th>
            <th scope="col">@lang('header.product.title_product')</th>
            <th scope="col">@lang('header.product.col_quantity') </th>
            <th scope="col">@lang('header.order.price') </th>
            <th scope="col">@lang('header.order.date')</th>
            <th scope="col">@lang('header.order.status')</th>
        </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <th scope="row">{{ $order->id }}</th>
                    <td>{{ $order->user->name }}</td>
                    <td>{{ $order->product->name }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td>{{ $order->amount }}</td>
                    <td>{{ $order->created_at }}</td>
                    <td class="btn-info status-order">{{ $order->getStatus() }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
