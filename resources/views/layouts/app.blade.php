<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if(auth()->check())
        <meta name="id_user" content="{{ auth()->id() }}">
        <meta name="count" content="{{auth()->user()->unreadnotifications()->count()}}">
    @endif
    <title>{{ config('app.name', 'Laravel') }}</title>
    {!! Html::script('js/app.js') !!}
    {!! Html::script('js/notification.js') !!}
    {!! Html::script('js/logout.js') !!}
    {!! Html::script('js/admin.js') !!}
    {!! Html::style('css/app.css') !!}
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
        @include('admin.include.toast')
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">@lang('header.login')</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">@lang('header.register')</a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a id="notifications" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="fa fa-globe"></i>  @lang('header.notification')
                                <span class="badge-danger badge" id="count-notification">
                                    {{ auth()->user()->unreadnotifications()->count() }}
                                </span>
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @foreach(auth()->user()->notifications as $notification)
                                    @if($notification->type == 'App\\Notifications\\NewOrder')
                                        <li class="dropdown-item  @if($notification->unread()) unseen @endif" id="notificationsMenu">
                                            <a class="nav-link seenSingle" id = "{{ $notification->id }}" href=" {{route('admin.user.show', ['id' => $notification->data['user_id']])}}">
                                                @lang('header.notification.neworder')<strong>{{ $notification->data['user_name'] }}</strong><p class="small float-right">{{ $notification->created_at->diffForHumans() }}</p>
                                            </a>
                                        </li>
                                    @else
                                        <li class="dropdown-item  @if($notification->unread()) unseen @endif" id="notificationsMenu">
                                            <a class="nav-link seenSingle" id = "{{ $notification->id }}"  href=" {{route('checkout.show', ['id' => auth()->id()])}}">
                                                @lang('header.notification.newstatusorder') <strong>{{ $notification->data['id_transaction'] }}</strong>@lang('header.notification.is')<strong>{{ $notification->data['status_transaction'] }}</strong><br><p class="small float-right">{{ $notification->created_at->diffForHumans() }}</p>
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                                @if (auth()->user()->unreadnotifications()->count() > config('setting.default_value_0'))
                                    <li class="dropdown-item " id="notificationsMenu">
                                        <a class="float-right seenAll" href="">@lang('header.notification.seeall')</a>
                                    </li>
                                @endif
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <span class="dropdown-item" id="logout-span">
                                        @lang('header.logout')
                                    </span>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            @if(Auth::check())
                <div class="col-lg-2" >
                    <ul class="list-group">
                        <li class="list-group-item">
                            <a href="{{route('home')}}">@lang('header.home')</a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{route('admin.order.index')}}">@lang('header.order.title')</a>
                        </li>
                        <li class="list-group-item">
                            <a href=" {{route('admin.suggest')}} ">@lang('header.suggest.title')</a>
                        </li>
                        <li class="list-group-item">
                            <a href=" {{route('admin.user.index')}} ">@lang('header.users.title_user')</a>
                        </li>
                        <li class="list-group-item">
                            <a href=" {{route('admin.user.create')}} ">@lang('header.users.title_new_user')</a>
                        </li>
                        <li class="list-group-item">
                            <a href=" {{route('admin.user.edit', ['id' => Auth::id()])}} ">@lang('header.users.title_profile')</a>
                        </li>
                        <li class="list-group-item">
                            <a href=" {{route('admin.category.index')}} ">@lang('header.category.title_category')</a>
                        </li>
                        <li class="list-group-item">
                            <a href=" {{route('admin.category.create')}} ">@lang('header.category.title_create')</a>
                        </li>
                        <li class="list-group-item">
                            <a href=" {{route('admin.product.index')}} ">@lang('header.product.title_product')</a>
                        </li>
                        <li class="list-group-item">
                            <a href=" {{route('admin.product.create')}} ">@lang('header.product.title_create')</a>
                        </li>
                        <li class="list-group-item">
                            <a href=" {{route('product.trashed')}} ">@lang('header.product.col_trash')</a>
                        </li>
                    </ul>
                </div>
            @endif
            <div class="col-lg-10">
                @yield('content')
            </div>
        </div>
    </div>
</div>
</body>
</html>
