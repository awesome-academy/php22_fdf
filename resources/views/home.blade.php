@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <a href = "">@lang('header.dashboard')</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-header text-center bg-info text-uppercase">
                        @lang('header.users.title_user')
                    </div>
                    <div class="card-body">
                        <h1 class="text-center">{{ $totalUser }}</h1>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="card">
                    <div class="card-header text-center bg-danger text-uppercase ">
                        @lang('header.order.transactions')
                    </div>
                    <div class="card-body">
                        <h1 class="text-center">{{ $totalTransactions }}</h1>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="card">
                    <div class="card-header text-center bg-light text-uppercase">
                        @lang('header.product.title_product')
                    </div>
                    <div class="card-body">
                        <h1 class="text-center">{{ $totalProduct }}</h1>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="card">
                    <div class="card-header text-center bg-info text-uppercase">
                        @lang('header.suggest.title')
                    </div>
                    <div class="card-body">
                        <h1 class="text-center">{{ $totalSuggest }}</h1>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12">
                <div>
                    {!! $chartByMonth->html() !!}
                </div>
                <hr>
                <div>
                    {!! $chartByYear->html() !!}
                </div>
            </div>
        </div>
    </div>

{!! Charts::scripts() !!}
{!! $chartByMonth->script() !!}
{!! $chartByYear->script() !!}
@endsection
