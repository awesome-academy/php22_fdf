@extends('layouts.frontend')
@section('title', @trans('layouts.single.title'))
@section('content')
    <section class="blog__list__view section-padding--lg menudetails-right-sidebar bg--white">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12">
                    <div class="food__menu__container">
                        <div class="food__menu__inner d-flex flex-wrap flex-md-nowrap flex-lg-nowrap">
                            <div class="food__menu__thumb">
                                <img src="{{asset('storage/uploads/cover_images/'. $product->images[config('setting.default_value_0')]->url)}}" alt="{{ $product->name }}" height="380" width="370" >
                            </div>
                            <div class="food__menu__details">
                                <div class="food__menu__content">
                                    <h2>{{ $product->name }}</h2>
                                    <ul class="food__dtl__prize d-flex">
                                        @if($product->discount > config('setting.default_value_0'))
                                            <li class="old__prize">@lang('layouts.cart.dollar'){{ $product->price }} </li>
                                        @endif
                                        <li>@lang('layouts.cart.dollar'){{ $product->newPrice() }} </li>
                                    </ul>
                                    <ul class="rating">
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                        <li><i class="fa fa-star"></i></li>
                                    </ul>
                                    <p>{{ $product->description }}</p>
                                    <div class="product-action-wrap">
                                        <div class="prodict-statas"><span>@lang('layouts.single.food_type') {{ $product->category->name }}</span></div>
                                        <div class="product-quantity">
                                                <div class="product-quantity">
                                                    <div class="cart-plus-minus">
                                                        <input type="text" class="cart-plus-minus-box quantity" name="qtybutton" value="2">
                                                        <div class="add__to__cart__btn">
                                                            <a class="food__btn add-btn" id="{{ $product->id }}" href="">@lang('layouts.single.add_cart')</a>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="menu__descrive__area">
                            <div class="menu__nav nav nav-tabs" role="tablist">
                                <a class="active" id="nav-all-tab" data-toggle="tab" href="#nav-all" role="tab">@lang('layouts.single.description')</a>
                                <a id="nav-breakfast-tab" data-toggle="tab" href="#nav-breakfast" role="tab">@lang('layouts.single.review')</a>
                            </div>
                            <div class="menu__tab__content tab-content" id="nav-tabContent">
                                <div class="single__dec__content fade show active" id="nav-all" role="tabpanel">
                                    <p>{{ $product->description }}</p>

                                </div>
                                <div class="single__dec__content fade" id="nav-breakfast" role="tabpanel">
                                    <div class="review__wrapper">
                                        <div class="single__review d-flex">
                                            <div class="review__thumb">
                                                <img src="images/testimonial/rev/1.jpg" alt="review images">
                                            </div>
                                            <div class="review__details">
                                                <h3></h3>
                                                <div class="rev__meta d-flex justify-content-between">
                                                    <span></span>
                                                    <ul class="rating">
                                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                        <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                    </ul>
                                                </div>
                                                <p></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="popupal__menu">
                                <h4>@lang('layouts.single.popular_menu')</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row mt--30">
                        @foreach($popular_products as $popular_product)
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <div class="beef_product">
                                    <div class="beef__thumb">
                                        <img src="{{asset('storage/uploads/cover_images/'. $popular_product->images[config('setting.default_value_0')]->url)}}" alt="{{ $popular_product->name }}">
                                    </div>
                                    <div class="beef__hover__info">
                                        <div class="beef__hover__inner">
                                            <span>@lang('layouts.single.special')</span>
                                            <span>@lang('layouts.single.offer')</span>
                                        </div>
                                    </div>
                                    <div class="beef__details">
                                        <h4><a href="{{ route('product.single', [ 'slug' => $popular_product->slug ]) }}">{{ $popular_product->name }}</a></h4>
                                        <ul class="beef__prize">
                                            <li class="old__prize">@lang('layouts.cart.dollar'){{ $popular_product->price }}</li>
                                            @if($popular_product->discount > config('setting.default_value_0'))
                                                <li>@lang('layouts.cart.dollar'){{ $popular_product->newPrice() }}</li>
                                            @endif
                                        </ul>
                                        <div class="beef__cart__btn">
                                            <a href="{{ route('cart.index') }}" class="add-btn" id="{{ $popular_product->id }}">@lang('layouts.single.add_cart')</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 md--mt--40 sm--mt--40">
                    <div class="food__sidebar">
                        <div class="food__search">
                            <h4 class="side__title">@lang('layouts.single.search')</h4>
                            <div class="serch__box">
                                <input type="text" placeholder="Search keyword">
                                <a href="#"><i class="fa fa-search"></i></a>
                            </div>
                        </div>
                        <div class="food__recent__post mt--60">
                            <h4 class="side__title">@lang('layouts.single.recent_product')</h4>
                            <div class="recent__post__wrap">
                                @foreach($category->products as $product)
                                    <div class="single__recent__post d-flex">
                                        <div class="recent__post__thumb">
                                            <a href="{{ route('product.single', [ 'slug' => $product->slug ]) }}">
                                                <img src="{{asset('storage/uploads/cover_images/'. $product->images[config('setting.default_value_0')]->url)}}" alt="{{ $product->name }}" width="120" height="100">
                                            </a>
                                        </div>
                                        <div class="recent__post__details">
                                            <h4><a href="{{ route('product.single', [ 'slug' => $product->slug ]) }}">{{ $product->name }}</a></h4>
                                        </div>
                                    </div>
                                 @endforeach
                            </div>
                        </div>
                        <div class="food__category__area mt--60">
                            <h4 class="side__title">@lang('layouts.single.categories')</h4>
                            <ul class="food__category">
                                @foreach ($categories as $category)
                                    @if ($category->childrens()->count() > config('setting.default_value_0'))
                                        @foreach ($category->childrens as $cate)
                                            <li><a href="{{ route('category.single', [ 'slug' => $cate->slug ]) }}">{{ $cate->name }}<span>({{ count($cate->products) }})</span></a></li>
                                        @endforeach
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
