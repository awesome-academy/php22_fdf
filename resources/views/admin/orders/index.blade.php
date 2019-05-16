@extends('layouts.app')
@section('content')
    @include('admin.include.errors')
    <div class="card">
        <div class="card-header">
            <a href = "">@lang('header.order.title')</a>
        </div>
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <label class="input-group-text" for="inputGroupSelect01">@lang('header.order.option')</label>
        </div>
        <select class="custom-select" id="choice">
            <option value="all">@lang('header.order.all')</option>
            <option value="Done">@lang('header.order.done')</option>
            <option value="Pending">@lang('header.order.pending')</option>
            <option value="Reject">@lang('message.status_reject')</option>
            @foreach ($transactions as $transaction)
                <option value="code{{$transaction->id}}">@lang('header.order.trading_code'){{$transaction->id}} || {{$transaction->created_at}} </option>
            @endforeach
        </select>
    </div>
    @foreach ($transactions as $transaction)
        <table class="table choice code{{$transaction->id}} {{ $transaction->getStatus() }}">
            <thead class="thead-dark">
            <tr>
                <th colspan="7">
                    @lang('header.order.trading_code') {{$transaction->id}} | {{ $transaction->created_at->diffForhumans() }}
                    <p class="status-transaction text-lg-left badge @if ($transaction->status == config('setting.default_value_0')) badge-info @elseif($transaction->status == config('setting.default_value_1')) badge-success @else badge-danger @endif" id="{{ $transaction->status }}{{ $transaction->id }}" >
                        {{$transaction->getStatus()}}
                    </p>
                </th>
            </tr>
            <tr>
                <th scope="col">@lang('header.order.id')</th>
                <th scope="col">@lang('header.product.lb_image')</th>
                <th scope="col">@lang('header.product.title_product')</th>
                <th scope="col">@lang('header.product.lb_price')</th>
                <th scope="col">@lang('header.product.col_quantity')</th>
                <th scope="col">@lang('header.order.sub_total')</th>
                <th scope="col">@lang('header.users.title_user')</th>
            </tr>
            </thead>
            <tbody>
            @foreach($transaction->order as $key => $or)
                <tr>
                    <th scope="row">{{ $key }}</th>
                    <td>
                        <img src="{{ asset('storage/uploads/cover_images/'. $or->product->images[config('setting.default_value_0')]->url)}}" alt="{{ $or->product->name }}" class="image_product">
                    </td>
                    <td>
                        <a href="{{route('admin.product.edit', ['id' => $or->product->id]) }}">
                            {{ $or->product->name }}
                        </a>
                    </td>
                    <td>{{ $or->product->price }}</td>
                    <td>{{ $or->quantity }}</td>
                    <td>{{ $or->amount }}</td>
                    <td>
                        <a href="{{route('admin.user.show', ['id' => $or->user->id]) }}">
                            {{ $or->user->name }}
                        </a>
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="6" class="text-center text-danger text-uppercase"> @lang('header.order.total')</td>
                <td>{{ $transaction->amount }}</td>
            </tr>
            </tbody>
        </table>
    @endforeach
@endsection
