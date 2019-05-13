@extends('layouts.app')
@section('content')
    @include('admin.include.errors')
    <div class="card">
        <div class="card-header">
            <a href = "{{ route('admin.user.show',['id' => $user->id]) }}">@lang('header.users.title_detail'): {{ $user->name }}</a>
        </div>
    </div>
    <div class="card-body">
        <div class="form-group" >
            <label class="col-sm-4 col-form-label font-weight-bold">@lang('header.users.header_name'):</label>
            {{ $user->name }}
        </div>
        <div class="form-group" >
            <label class="col-sm-4 col-form-label font-weight-bold">@lang('header.email'):</label>
            {{ $user->email }}
        </div>
        <div class="form-group" >
            <label class="col-sm-4 col-form-label font-weight-bold">@lang('header.phone'):</label>
            {{ $user->phone }}
        </div>
        <div class="form-group" >
            <label class="col-sm-4 col-form-label font-weight-bold">@lang('header.address'):</label>
            {{ $user->address }}
        </div>
        <div class="form-group" >
            <label class="col-sm-4 col-form-label font-weight-bold">@lang('header.create_at'):</label>
            <time class="published">
                {{ $user->created_at->toFormattedDateString() }}
            </time>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h2>@lang('header.order.user_order')</h2>
            @if ($transactions->count() > config('setting.default_value_0'))
                @foreach($transactions as $transaction)
                    <hr>
                    <div class="card">
                        <div class="card-body">
                            <ul class="list-group">
                                @lang('header.order.trading_code') {{$transaction->id}} | {{$transaction->created_at->toFormattedDateString() }}
                                <span class="badge-success">
                                        {{ $transaction->getStatus() }}
                                    </span>
                                @foreach($transaction->order as $or)
                                    <li class="list-group-item">
                                    <span class="badge-info float-right">
                                        @lang('layouts.cart.dollar'){{$or->amount}} ({{$or->getStatus()}})
                                    </span>
                                        {{$or->product->name}} | {{$or->quantity}}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="card-footer">
                            <strong> @lang('header.order.total_price') {{$transaction->amount}} </strong>
                        </div>
                    </div>
                @endforeach
            @else
                <div>
                    <span class="text-center">@lang('header.order.no_order')</span>
                </div>
            @endif
        </div>
    </div>
@endsection
