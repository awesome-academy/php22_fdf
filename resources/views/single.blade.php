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
                                        @for ($i = config('setting.default_start_begin'); $i < config('setting.default_start_end'); $i++ )
                                            @if ($i <= $product->rating)
                                                <li><i class="fa fa-star rate" ></i></li>
                                            @else
                                                <li><i class="fa fa-star"  ></i></li>
                                            @endif
                                        @endfor
                                    </ul>
                                    <p>{{ $product->description }}</p>
                                    <div class="product-action-wrap">
                                        <div class="prodict-statas"><span>@lang('layouts.single.food_type') {{ $product->category->name }}</span></div>
                                        <div class="product-quantity">
                                            <div class="add__to__cart__btn">
                                                <input type="number" class="input_quantity quantity " name="qtybutton" value="2" max="{{$product->quantity}}">
                                                <button class="food__btn add-btn" id="{{ $product->id }}">@lang('layouts.single.add_cart')</button>
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
                                        @foreach($feedbacks as $feedback)
                                            <div class="single__review d-flex">
                                                <div class="review__details">
                                                    <h3>{{$feedback->user->name}}</h3>
                                                    <div class="rev__meta d-flex justify-content-between">
                                                        <span>{{ $feedback->created_at->toFormattedDateString()}}</span>
                                                        <ul class="rating">
                                                            @for ($i = config('setting.default_start_begin'); $i < config('setting.default_start_end'); $i++ )
                                                                @if ($i <= $feedback->rating)
                                                                    <li><i class="fa fa-star rate" ></i></li>
                                                                @else
                                                                    <li><i class="fa fa-star"  ></i></li>
                                                                @endif
                                                            @endfor
                                                        </ul>
                                                    </div>
                                                    <p>{{$feedback->content}}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                        @if (Auth::check())
                                            <div class="single__review d-flex single__review_user">
                                                <div class="review__details">
                                                    <div class="rev__meta d-flex justify-content-between">
                                                        <ul class="rating rating-review">
                                                            <li><i class="fa fa-star"  data-rating="1"></i></li>
                                                            <li><i class="fa fa-star"  data-rating="2"></i></li>
                                                            <li><i class="fa fa-star"  data-rating="3"></i></li>
                                                            <li><i class="fa fa-star"  data-rating="4"></i></li>
                                                            <li><i class="fa fa-star"  data-rating="5"></i></li>
                                                            <input type="hidden" name="whatever1" class="rating-value" value="2.56">
                                                        </ul>
                                                    </div>

                                                    <div>
                                                        <input class="form-control form-control-lg review-text" type="text" >
                                                        <br>
                                                        <span class="btn-success btn review" id="{{$product->id}}">@lang('layouts.single.review')</span>
                                                    </div>

                                                </div>
                                            </div>
                                        @endif
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
