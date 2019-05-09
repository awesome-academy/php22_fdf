<header class="htc__header bg--white">
    <div id="sticky-header-with-topbar" class="mainmenu__wrap sticky__header">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-sm-4 col-md-6 order-1 order-lg-1">
                    <div class="logo">
                        <a href="{{ route('index') }}">
                            <img src="{{ asset('app/images/logo/foody.png') }}" alt="logo images">
                        </a>
                    </div>
                </div>
                <div class="col-lg-9 col-sm-4 col-md-2 order-3 order-lg-2">
                    <div class="main__menu__wrap">
                        <nav class="main__menu__nav d-none d-lg-block">
                            <ul class="mainmenu">
                                <li class="drop"><a href="{{ route('index') }}">@lang('header.home')</a></li>
                                @foreach ($categories as $category)
                                    @if ($category->childrens()->count() > config('setting.default_value_0'))
                                        <li class="drop"><a href="">{{ $category->name }}</a>
                                            <ul class="dropdown__menu">
                                                @foreach ($category->childrens as $cate)
                                                        <li><a href="">{{ $cate->name }}</a></li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    @endif
                                @endforeach
                                <li><a href="contact.html">@lang('layouts.header.title_contact')</a></li>
                            </ul>
                        </nav>

                    </div>
                </div>
                <div class="col-lg-1 col-sm-4 col-md-4 order-2 order-lg-3">
                    <div class="header__right d-flex justify-content-end">
                        <div class="log__in">
                            @guest
                                <a class="accountbox-trigger" href="#"><i class="zmdi zmdi-account-o"></i></a>
                            @else
                                <div class="main__menu__wrap">
                                    <nav class="main__menu__nav d-none d-lg-block">
                                        <ul class="mainmenu">
                                            <li class="drop"><a id="user_name">{{ Auth::user()->name }}</a>
                                                <ul class="dropdown__menu">
                                                    @if (Auth::user()->isAdmin())
                                                        <li>
                                                            <a href="{{ route('home') }}">@lang('header.users.col_admin')</a>
                                                        </li>
                                                    @endif
                                                    <li>
                                                        <a href="">@lang('header.users.title_profile')</a>
                                                    </li>
                                                    <li id="logout-span">
                                                        <a>@lang('header.logout')</a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            @endguest
                        </div>
                        <div class="shopping__cart">
                            <a class="minicart-trigger" href="#"><i class="zmdi zmdi-shopping-basket"></i></a>
                            <div class="shop__qun">
                                <span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
