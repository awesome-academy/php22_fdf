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
                @if ($product->quantity !=  config('setting.default_value_0') )
                    <a class="food__btn grey--btn theme--hover" href="{{ route('product.single', [ 'slug' => $product->slug ]) }}">@lang('layouts.index.btn_order_now')</a>
                @else
                    <a class="food__btn grey--btn theme--hover" >@lang('layouts.sold_out')</a>
                @endif
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
                @for ($i = config('setting.default_start_begin'); $i < config('setting.default_start_end'); $i++ )
                    @if ($i <= $product->rating)
                        <li><i class="fa fa-star rate" ></i></li>
                    @else
                        <li><i class="fa fa-star"  ></i></li>
                    @endif
                @endfor
            </ul>
        </div>
    </div>
</div>
