@extends('layouts.frontend')
@section('title', @trans('layouts.cart.title'))
@section('content')
    <div class="cart-main-area section-padding--lg bg--white">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 ol-lg-12">
                    {!! Form::open(['method' => 'post', 'class' => 'form-cart']) !!}
                        <div class="table-content table-responsive">
                            <table>
                                <thead>
                                    <tr class="title-top">
                                        <th class="product-thumbnail">@lang('header.product.lb_image')</th>
                                        <th class="product-name">@lang('header.product.title_product')</th>
                                        <th class="product-price">@lang('header.product.col_price')</th>
                                        <th class="product-quantity">@lang('header.product.col_quantity')</th>
                                        <th class="product-subtotal">@lang('layouts.footer.total')</th>
                                        <th class="product-remove">@lang('layouts.cart.remove')</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if (Session::has('cart'))
                                    @foreach($product_cart as $product)
                                    <tr id='delete-item{{ $product['item']['id'] }}'>
                                        <td class="product-thumbnail">
                                            <a href="{{ route('product.single', [ 'slug' => $product['item']['slug'] ]) }}">
                                                <img src="{{asset('storage/uploads/cover_images/'. $product['item']['images'][config('setting.default_value_0')]->url)}}" alt="small thumbnail">
                                            </a>
                                        </td>
                                        <td class="product-name"><a href="{{ route('product.single', [ 'slug' => $product['item']['slug'] ]) }}">{{ $product['item']['name'] }}</a></td>
                                        <td class="product-price"><span class="amount">@lang('layouts.cart.dollar'){{ $product['item']['price'] }}</span></td>
                                        <td class="product-quantity"><input type="number" value="{{ $product['quantity'] }}" name="number_quantity{{ $product['item']['id'] }}" /></td>
                                        <td class="product-subtotal">@lang('layouts.cart.dollar'){{ $product['price'] }}</td>
                                        <td class="product-remove"><a class="delete-item" id="{{ $product['item']['id'] }}">@lang('layouts.cart.delete_x')</a></td>
                                    </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>

                        <div class="cartbox__btn">
                            <ul class="cart__btn__list d-flex flex-wrap flex-md-nowrap flex-lg-nowrap justify-content-between">
                                <li></li>
                                <li></li>
                                <li><input type="submit" href="" value="{{@trans('layouts.cart.update_cart')}}"/></li>
                                <li><a href="{{route('checkout.index')}}">@lang('layouts.footer.checkout')</a></li>
                            </ul>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 offset-lg-6">
                    <div class="cartbox__total__area">
                        <div class="cart__total__amount">
                            <span>@lang('layouts.cart.grand_total')</span>
                            @if(Session::has('cart'))
                                <span class="totalPrice">@lang('layouts.cart.dollar'){{ $totalPrice }}</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
