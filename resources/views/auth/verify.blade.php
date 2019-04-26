@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">@lang('message.verity_mail')</div>

                    <div class="card-body">
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                @lang('message.verity_success')
                            </div>
                        @endif
                        @lang('message.verity_check')
                        @lang('message.verity_receive'), <a href="{{ route('verification.resend') }}">@lang('message.verity_click')</a>.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
