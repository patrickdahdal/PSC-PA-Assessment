@extends('frontend.layouts.default')
@section('page_heading', trans('front.pages.auth.title'))
@section('content')
    <div class="row" style="background-size: 75%; background-image: url(/theme/assets/media/bg/bg-3.jpg);">
        <div class="col-xl-10">
            <div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v3 kt-login--signin" id="kt_login">
                <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
                    <div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper">
                        <div class="kt-login__container">
                            <div class="kt-login__signin">
                                <div class="kt-login__head">
                                    <h3 class="kt-login__title">Sign In To Customer Area</h3>
                                </div>
                                <form class="kt-form" method="POST" action="{{ route('account.auth.login') }}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="_redirect" value="{{ Request::path() }}">

                                    <div class="input-group">
                                        <input class="form-control" type="email" name="email" placeholder="@lang('front.auth.email')" value="{{ old('email') }}" autocomplete="off">
                                    </div>
                                    <div class="input-group">
                                        <input class="form-control" type="password" name="password" placeholder="@lang('front.auth.password')">
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="col-md-6 col-md-offset-4 mt-4">
                                            <a href="{{ route('customers.password.showLinkRequestForm') }}">Forgot your password?</a>
                                        </div>
                                    </div>

                                    <div class="row kt-login__extra">
                                        <div class="col">
                                            <label class="kt-checkbox">
                                                <input type="checkbox" name="remember"> @lang('front.auth.remember')
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="kt-login__actions">
                                        <button type="submit" id="kt_login_signin_submit" class="btn btn-brand btn-elevate kt-login__btn-primary">@lang('front.auth.login')</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop