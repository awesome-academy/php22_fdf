@extends('layouts.frontend')
@section('content')
    <section class="food__menu__grid__area section-padding--lg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="food__nav nav nav-tabs">
                        @if ($category->parent)
                            <a class="active" id="nav-all-tab"  href="{{ route('category.single', [ 'slug' => $category->parent->slug ]) }}">{{ $category->parent->name }}</a>
                        @endif
                        <a class="active" id="nav-all-tab"  href="{{ route('category.single', [ 'slug' => $category->slug ]) }}">{{ $category->name }}</a>
                        @if ($category->childrens()->count() > config('setting.default_value_0') )
                            @foreach( $category->childrens as $cate)
                                <a class="active" id="nav-all-tab"  href="{{ route('category.single', [ 'slug' => $cate->slug ]) }}">{{ $cate->name }}</a>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="row mt--30">
                <div class="col-lg-12">
                    <div class="fd__tab__content tab-content" id="nav-tabContent">
                        <div class="food__list__tab__content tab-pane fade show active" id="nav-all" role="tabpanel">
                            @if ($category->childrens()->count() > config('setting.default_value_0') )
                                @foreach( $category->childrens as $cate)
                                    @foreach($cate->products as $product)
                                        @include('includes.product')
                                    @endforeach
                                @endforeach
                            @else
                                @foreach($products as $product)
                                    @include('includes.product')
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <ul class="food__pagination d-flex justify-content-center align-items-center mt--130">
                        <li><a href="#"><i class="zmdi zmdi-chevron-left"></i></a></li>
                        <li><a href="#"><i class="zmdi zmdi-chevron-right"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection
