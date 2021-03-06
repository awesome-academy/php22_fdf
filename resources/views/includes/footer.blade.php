<footer class="footer__area footer--1">
    <div class="footer__wrapper bg__cat--1 section-padding--lg">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-lg-3 col-sm-12">
                    <div class="footer">
                        <h2 class="ftr__title">@lang('layouts.footer.about_store')</h2>
                        <div class="footer__inner">
                            <div class="ftr__details">
                                <p>@lang('layouts.footer.description_store')</p>
                                <div class="ftr__address__inner">
                                    <div class="ftr__address">
                                        <div class="ftr__address__icon">
                                            <i class="zmdi zmdi-home"></i>
                                        </div>
                                        <div class="frt__address__details">
                                            <p>@lang('layouts.footer.address_store')</p>
                                        </div>
                                    </div>
                                    <div class="ftr__address">
                                        <div class="ftr__address__icon">
                                            <i class="zmdi zmdi-phone"></i>
                                        </div>
                                        <div class="frt__address__details">
                                            <p><a href="#"></a>@lang('layouts.footer.phone1_store')</p>
                                            <p><a href="#"></a>@lang('layouts.footer.phone2_store')</p>
                                        </div>
                                    </div>
                                    <div class="ftr__address">
                                        <div class="ftr__address__icon">
                                            <i class="zmdi zmdi-email"></i>
                                        </div>
                                        <div class="frt__address__details">
                                            <p><a href="#">@lang('layouts.footer.mail_store')</a></p>
                                        </div>
                                    </div>
                                </div>
                                <ul class="social__icon">
                                    <li><a href="#"><i class="zmdi zmdi-facebook"></i></a></li>
                                    <li><a href="#"><i class="zmdi zmdi-google"></i></a></li>
                                    <li><a href="#"><i class="zmdi zmdi-instagram"></i></a></li>
                                    <li><a href="#"><i class="zmdi zmdi-rss"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 col-sm-12 md--mt--40 sm--mt--40">
                    <div class="footer">
                        <h2 class="ftr__title">@lang('layouts.footer.title_open_time_store')</h2>
                        <div class="footer__inner">
                            <ul class="opening__time__list">
                                <li>@lang('layouts.footer.monday')<span>.......</span>@lang('layouts.footer.open_time_store')</li>
                                <li>@lang('layouts.footer.tuesday')<span>.......</span>@lang('layouts.footer.open_time_store')</li>
                                <li>@lang('layouts.footer.wednesday')<span>.......</span>@lang('layouts.footer.open_time_store')</li>
                                <li>@lang('layouts.footer.thursday')<span>.......</span>@lang('layouts.footer.open_time_store')</li>
                                <li>@lang('layouts.footer.friday')<span>.......</span>@lang('layouts.footer.open_time_store')</li>
                                <li>@lang('layouts.footer.staturday')<span>.......</span>@lang('layouts.footer.open_time_store')</li>
                                <li>@lang('layouts.footer.sunday')<span>.......</span>@lang('layouts.footer.open_time_store')</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<div class="accountbox-wrapper">
    <div class="accountbox text-left">
        <ul class="nav accountbox__filters" id="myTab" role="tablist">
            <li>
                <a class="active" id="log-tab" data-toggle="tab" href="#log" role="tab" aria-controls="log" aria-selected="true">@lang('header.login')</a>
            </li>
            <li>
                <a id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">@lang('header.register')</a>
            </li>
        </ul>
        <div class="accountbox__inner tab-content" id="myTabContent">
            <div class="accountbox__login tab-pane fade show active" id="log" role="tabpanel" aria-labelledby="log-tab">
                {!! Form::open([ 'route' => 'postLogin', 'method' => 'POST']) !!}
                    <div class="single-input">
                        {!! Form::text('email', '', [ 'class' => 'cr-round--lg', 'placeholder' => @trans('layouts.footer.your_mail'), 'required' => 'required']) !!}
                    </div>
                    <div class="single-input">
                        {!! Form::password('password', [ 'class' => 'cr-round--lg', 'placeholder' => @trans('header.password'), 'required' => 'required']) !!}
                    </div>
                    <div class="single-input">
                        {!! Form::button('<span>' . @trans('layouts.footer.go') .'</span>',['class' => 'food__btn', 'type' => 'submit']) !!}
                    </div>
                    <div class="single-input">
                        @if(Session::has('status'))
                            <span class="text-danger">{{ Session::get('status') }}</span>
                        @endif
                    </div>
                    <div class="accountbox-login__others">
                        <h6>@lang('layouts.footer.login_with')</h6>
                        <div class="social-icons">
                            <ul>
                                <li class="facebook"><a href="{{ route('redirect.social', ['social' => 'facebook']) }}"><i class="fa fa-facebook"></i></a></li>
                                <li class="twitter"><a href="https://twitter.com/"><i class="fa fa-twitter"></i></a></li>
                                <li class="pinterest"><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>

            <div class="accountbox__register tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                {!! Form::open(['route' => 'postRegister', 'method' => 'post']) !!}
                    <div class="single-input">
                        {!! Form::text('user_name', '', [ 'class' => 'cr-round--lg', 'placeholder' => @trans('header.name')]) !!}
                    </div>
                    <div class="single-input">
                        {!! Form::text('user_email', '', [ 'class' => 'cr-round--lg', 'placeholder' => @trans('header.email')]) !!}
                    </div>
                    <div class="single-input">
                        {!! Form::password('password', [ 'class' => 'cr-round--lg', 'placeholder' => @trans('header.password')]) !!}
                    </div>
                    <div class="single-input">
                        {!! Form::password('confirm_password', [ 'class' => 'cr-round--lg', 'placeholder' => @trans('header.confirm_password')]) !!}
                    </div>
                    <div class="single-input">
                        {!! Form::button('<span>' . @trans('layouts.footer.sign_up') .'</span>', ['class' => 'food__btn', 'type' => 'submit']) !!}
                    </div>
                {!! Form::close() !!}
            </div>
            <span class="accountbox-close-button"><i class="zmdi zmdi-close"></i></span>
        </div>
    </div>
</div>
