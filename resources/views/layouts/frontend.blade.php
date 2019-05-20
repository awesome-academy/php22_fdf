<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> {{ config('setting.title') }}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @if(auth()->check())
        <meta name="id_user" content="{{ auth()->id() }}">
        <meta name="count" content="{{auth()->user()->unreadnotifications()->count()}}">
    @endif
    <link rel="shortcut icon" href="{{ asset('app/images/favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('app/images/icon.png') }}">

    {!! Html::style('css/app.css') !!}
    {!! Html::style('app/css/bootstrap.min.css') !!}
    {!! Html::style('app/css/plugins.css') !!}
    {!! Html::style('app/css/style.css') !!}
    {!! Html::style('app/css/custom.css') !!}
</head>
<body>
<div class="wrapper" id="wrapper">
@include('includes.header')
@include('admin.include.toast')
    <div class="ht__bradcaump__area bg-image--18">
        <div class="ht__bradcaump__wrap d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="bradcaump__inner text-center">
                            <h2 class="bradcaump-title">@yield('title','All food & drinks')</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@yield('content')
@include('includes.footer')
</div>
{!! Html::script('js/app.js') !!}
{!! Html::script('js/notification.js') !!}
{!! Html::script('js/admin.js') !!}
{!! Html::script('js/shop.js') !!}
{!! Html::script('js/logout.js') !!}
{!! Html::script('app/js/vendor/jquery-3.2.1.min.js') !!}
{!! Html::script('app/js/popper.min.js') !!}
{!! Html::script('app/js/bootstrap.min.js') !!}
{!! Html::script('app/js/plugins.js') !!}
{!! Html::script('app/js/active.js') !!}
</body>
</html>
