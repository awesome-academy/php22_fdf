<div class="single__food__list d-flex wow fadeInUp">
    <div class="food__list__thumb">
        <a href="{{ route('product.single', [ 'slug' => $product->slug ]) }}">
            <img src="{{ asset('storage/uploads/cover_images/'. $product->images[config('setting.default_value_0')]->url )}}" alt="{{$product->name}}" width="469px" height="253px">
        </a>
    </div>
    <div class="food__list__inner d-flex align-items-center justify-content-between">
        <div class="food__list__details">
            <h2><a href="{{ route('product.single', [ 'slug' => $product->slug ]) }}">{{ $product->name }}</a></h2>
            <p>{{ $product->description }}</p>
            <div class="list__btn">
                <a class="food__btn grey--btn theme--hover" href="menu-details.html">@lang('layouts.index.btn_order_now')</a>
            </div>
        </div>
        <div class="food__rating">
            <div class="list__food__prize">
                <span>
                    @lang('layouts.cart.dollar'){{ $product->newPrice() }}
                    @if ($product->discount > config('setting.default_value_0'))
                        @lang('layouts.single.asterisk')
                    @endif
                </span>
            </div>
            <ul class="rating">
                <li><i class="zmdi zmdi-star"></i></li>
                <li><i class="zmdi zmdi-star"></i></li>
                <li><i class="zmdi zmdi-star"></i></li>
                <li><i class="zmdi zmdi-star"></i></li>
                <li class="rating__opasity"><i class="zmdi zmdi-star"></i></li>
            </ul>
        </div>
    </div>
</div>
