@extends('layouts.frontend')
@section('title', @trans('layouts.order.title'))
@section('content')
    <section class="htc__checkout bg--white section-padding--lg">
        <div class="checkout-section">
            <div class="container">
                @if ($transactions->count() > config('setting.default_value_0'))
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
                    @foreach($transactions as $transaction)
                        <div class="single-accordion choice code{{$transaction->id}} {{ $transaction->getStatus() }}">
                            <span class="accordion-head" data-toggle="collapse" data-parent="#checkout-accordion" href="#checkout-method{{$transaction->id}}">
                                @lang('header.order.trading_code') {{$transaction->id}} | {{$transaction->created_at}}
                                <p class="status-transaction text-lg-left badge @if ($transaction->status == config('setting.default_value_0')) badge-info @elseif($transaction->status == config('setting.default_value_1')) badge-success @else badge-danger @endif" >
                                    {{$transaction->getStatus()}}
                                </p>
                            </span>
                            <div id="checkout-method{{$transaction->id}}" class="collapse ">
                                <div class="checkout-method accordion-body fix">
                                    <table class="table table-bordered table-dark">
                                        <thead>
                                        <tr>
                                            <th scope="col">@lang('header.order.id')</th>
                                            <th scope="col">@lang('header.product.lb_image')</th>
                                            <th scope="col">@lang('header.product.title_product')</th>
                                            <th scope="col">@lang('header.product.lb_price')</th>
                                            <th scope="col">@lang('header.product.col_quantity')</th>
                                            <th scope="col">@lang('header.order.sub_total')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($transaction->order as $key => $or)
                                            <tr>
                                                <td scope="row">{{ $key }}</td>
                                                <td>
                                                    <img src="{{ asset('storage/uploads/cover_images/'. $or->product->images[config('setting.default_value_0')]->url)}}" alt="{{ $or->product->name }}" class="image_product">
                                                </td>
                                                <td>{{ $or->product->name }}</td>
                                                <td>{{ $or->product->price  }}</td>
                                                <td>{{ $or->quantity }}</td>
                                                <td>{{ $or->amount }}</td>
                                            </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="5" class="text-center text-danger text-uppercase"> @lang('header.order.total')</td>
                                            <td>{{ $transaction->amount }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
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
    </section>
@endsection
