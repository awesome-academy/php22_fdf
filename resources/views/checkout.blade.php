@extends('layouts.frontend')
@section('title', @trans('layouts.checkout.title'))
@section('content')
    <section class="htc__checkout bg--white section-padding--lg">
        <div class="checkout-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-12 mb-30">
                        <div id="checkout-accordion">
                            <div class="single-accordion">
                                <a class="accordion-head" data-toggle="collapse" data-parent="#checkout-accordion" href="#checkout-method">@lang('layouts.checkout.check_method')</a>
                                @if (!Auth::check())
                                    <div id="checkout-method" class="collapse show">
                                        <div class="checkout-method accordion-body fix">
                                            <ul class="checkout-method-list">
                                                <li class="active" data-form="checkout-login-form">@lang('header.login')</li>
                                                <li data-form="checkout-register-form">@lang('header.register')</li>
                                            </ul>
                                            {!! Form::open([ 'route' => 'postLogin', 'method' => 'POST', 'class' => 'checkout-login-form' ]) !!}
                                                <div class="row">
                                                    <div class="input-box col-md-6 col-12 mb--20">{!! Form::text('email', '', [ 'class' => 'cr-round--lg', 'placeholder' => @trans('layouts.footer.your_mail'), 'required' => 'required']) !!}</div>
                                                    <div class="input-box col-md-6 col-12 mb--20">{!! Form::password('password', [ 'class' => 'cr-round--lg', 'placeholder' => @trans('header.password'), 'required' => 'required']) !!}</div>
                                                    <div class="input-box col-12"> {!! Form::submit(@trans('header.login')) !!}</div>
                                                </div>
                                            {!! Form::close() !!}

                                            {!! Form::open(['route' => 'postRegister', 'method' => 'post', 'class' => 'checkout-register-form']) !!}
                                                <div class="row">
                                                    <div class="input-box col-md-6 col-12 mb--20"> {!! Form::text('name', '', [ 'class' => 'cr-round--lg', 'placeholder' => @trans('header.name')]) !!}</div>
                                                    <div class="input-box col-md-6 col-12 mb--20"> {!! Form::text('email', '', [ 'class' => 'cr-round--lg', 'placeholder' => @trans('header.email')]) !!}</div>
                                                    <div class="input-box col-md-6 col-12 mb--20"> {!! Form::password('user_password', [ 'class' => 'cr-round--lg', 'placeholder' => @trans('header.password')]) !!}</div>
                                                    <div class="input-box col-md-6 col-12 mb--20"> {!! Form::password('confirm_password', [ 'class' => 'cr-round--lg', 'placeholder' => @trans('header.confirm_password')]) !!}</div>
                                                    <div class="input-box col-12">{!! Form::submit(@trans('header.register')) !!}</div>
                                                </div>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                @endif

                            </div>

                            <div class="single-accordion">
                                <a class="accordion-head collapsed" data-toggle="collapse" data-parent="#checkout-accordion" href="#billing-method">2. Information</a>
                                <div id="billing-method" class="collapse">
                                    @if( Auth::check())
                                        <div class="accordion-body billing-method fix">
                                            {!! Form::open(['class' => 'billing-form checkout-form', 'method' => 'POST']) !!}
                                            <div class="row">
                                                <div class="col-12 mb--20">
                                                    {!! Form::text('name', Auth::user()->name , ['placeholder' => 'Name'] ) !!}
                                                </div>
                                                <div class="col-12 mb--20">
                                                    {!! Form::text('address', Auth::user()->address, ['placeholder' => 'Address']) !!}
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    {!! Form::text('phone', Auth::user()->phone, ['placeholder' => 'Phone Number' ]) !!}
                                                </div>
                                                <div class="badge badge-danger ">
                                                    {!! Form::submit(@trans('layouts.checkout.change')) !!}
                                                </div>
                                            </div>
                                            {!! Form::close() !!}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-12 mb-30">

                        <div class="order-details-wrapper">
                            <h2>@lang('layouts.checkout.your_order')</h2>
                            <div class="order-details">
                                {!! Form::open(['route' => ['checkout.store', 'id' => auth()->id() ], 'method' => 'post', 'class' => 'checkout-form']) !!}
                                    <ul>
                                        <li><p class="strong">@lang('header.product.title_product')</p><p class="strong">@lang('layouts.footer.total')</p></li>
                                        @foreach ($cart->items as $item)
                                            <li>
                                                <p>{{ $item['item']->name }} &#215; {{ $item['quantity'] }}</p>
                                                <p>@lang('layouts.cart.dollar'){{ $item['price'] }}</p>
                                            </li>
                                        @endforeach
                                        <li><p class="strong">@lang('layouts.checkout.cart_subtotal')</p><p class="strong">@lang('layouts.cart.dollar'){{ $cart->totalPrice }}</p></li>
                                        <li><p class="strong">@lang('layouts.checkout.order_total')</p><p class="strong">@lang('layouts.cart.dollar'){{ $cart->totalPrice }}</p></li>
                                        <li>
                                            {!! Form::label('message') !!}
                                            {!! Form::text('message', ' ') !!}
                                        </li>
                                        <li>
                                            {!! Form::submit(@trans('layouts.checkout.place_order'), ['class' => 'food__btn']) !!}
                                        </li>
                                    </ul>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
