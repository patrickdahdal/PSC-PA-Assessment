@extends('frontend.layouts.app')
@section('body')
    <!-- begin:: Header Mobile -->
    <div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
        <div class="kt-header-mobile__logo">
            <a href="{{ url('/') }}">
                <img alt="@lang('global.site.title')" src="/images/site-logo.png" height="50" />
            </a>
        </div>
        <div class="kt-header-mobile__toolbar">
            <button class="kt-header-mobile__toolbar-toggler" id="kt_header_mobile_toggler"><span></span></button>
            <button class="kt-header-mobile__toolbar-topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more-1"></i></button>
        </div>
    </div>

    <!-- end:: Header Mobile -->
    <div class="kt-grid kt-grid--hor kt-grid--root">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper " id="kt_wrapper">
                <!-- begin:: Header -->
                <div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed " data-ktheader-minimize="on">
                    <div class="kt-header__top">
                        <div class="kt-container">
                            <!-- begin:: Brand -->
                            <div class="kt-header__brand   kt-grid__item" id="kt_header_brand">
                                <div class="kt-header__brand-logo">
                                    <a href="{{ url('/') }}">
                                        <img alt="@lang('global.site.title')" src="/images/site-logo.png" height="50" class="kt-header__brand-logo-default" />
                                    </a>
                                </div>
                                <div class="kt-header__brand-nav" style="margin-left:5.0rem">
                                    <a href="{{ url('/membercode') }}" class="btn btn-outline-brand {{ ((Request::is('membercode') || Request::is('register') || Request::is('test')) ? 'active' : '') }}">
                                        <i class="fa flaticon2-fast-next"></i> @lang('front.pages.test.menu')
                                    </a>
                                </div>
                            </div>
                            <!-- end:: Brand -->

                        @if (session('customer_id') && session('customer_auth'))
                            <!-- begin:: Header Topbar -->
                                <div class="kt-header__topbar kt-grid__item kt-grid__item--fluid">
                                    <!--begin: User bar -->
                                    <div class="kt-header__topbar-item dropdown">
                                        <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px">
                                            <span class="kt-header__topbar-icon kt-header__topbar-icon--primary"><i class="flaticon2-user"></i></span>
                                        </div>
                                        <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-xl">
                                            <!-- begin:: Subheading -->
                                            <div class="kt-mycart">
                                                <div class="kt-mycart__head kt-head" style="background-image: url(/theme/assets/media/misc/bg-1.jpg);">
                                                    <div class="kt-mycart__info">
                                                        <span class="kt-mycart__icon"><i class="flaticon2-user kt-font-success"></i></span>
                                                        <h3 class="kt-mycart__title">@lang('front.pages.account.title')</h3>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end:: Subheading -->

                                            <!--begin: Navigation -->
                                            <div class="kt-notification">
                                                <a href="{{ route('account.profile') }}" class="kt-notification__item">
                                                    <div class="kt-notification__item-icon">
                                                        <i class="flaticon2-calendar-3 kt-font-success"></i>
                                                    </div>
                                                    <div class="kt-notification__item-details">
                                                        <div class="kt-notification__item-title kt-font-bold">
                                                            @lang('front.pages.profile.link')
                                                        </div>
                                                        <div class="kt-notification__item-time">
                                                            @lang('front.pages.profile.descr')
                                                        </div>
                                                    </div>
                                                </a>
                                                <a href="{{ route('account.index') }}" class="kt-notification__item">
                                                    <div class="kt-notification__item-icon">
                                                        <i class="flaticon-diagram kt-font-danger"></i>
                                                    </div>
                                                    <div class="kt-notification__item-details">
                                                        <div class="kt-notification__item-title kt-font-bold">
                                                            @lang('front.pages.results.link')
                                                        </div>
                                                        <div class="kt-notification__item-time">
                                                            @lang('front.pages.results.descr')
                                                        </div>
                                                    </div>
                                                </a>

                                                <div class="kt-notification__custom">
                                                    <a href="{{ route('account.auth.logout') }}" class="btn btn-label-brand btn-sm btn-bold">@lang('front.auth.logout')</a>
                                                </div>
                                            </div>
                                            <!--end: Navigation -->
                                        </div>
                                    </div>
                                    <!--end: User bar -->
                                </div>
                                <!-- end:: Header Topbar -->
                            @endif
                        </div>
                    </div>
                    <div class="kt-header__bottom">
                        <div class="kt-container">
                            <!-- begin: Header Menu -->
                            <button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
                            <div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper">
                                <div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile ">
                                    <ul class="kt-menu__nav ">
                                        <li class="kt-menu__item " aria-haspopup="true">
                                            <a href="" class="kt-menu__link "><span class="kt-menu__link-text">@yield('page_heading')</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- end: Header Menu -->
                        </div>
                    </div>
                </div>
                <!-- end:: Header -->

                <!-- begin:: Content -->
                <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-grid--stretch">
                    <div class="kt-container kt-body  kt-grid kt-grid--ver" id="kt_body">
                        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor">
                            <div class="kt-content kt-grid__item kt-grid__item--fluid" style="margin-top:2.5rem">
                                <!-- begin:: System Messages -->
                                @if (Session::has('success'))
                                    <div class="alert alert-success">
                                        <p>{{ Session::get('success') }}</p>
                                    </div>
                                @endif

                                @if (Session::has('message'))
                                    <div class="alert alert-info">
                                        <p>{{ Session::get('message') }}</p>
                                    </div>
                                @endif

                                @if ($errors->count() > 0)
                                    <div class="alert alert-warning">
                                        @foreach ($errors->all() as $error)
                                            <p>{{ $error }}</p>
                                        @endforeach
                                    </div>
                                @endif
                                <!-- end:: System Messages -->

                                <!-- begin:: Main Page Content -->
                                @yield('content')
                                <!-- end:: Main Page Content -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end:: Content -->

                <!-- begin:: Footer -->
                <div class="kt-footer kt-grid__item" id="kt_footer">
                    <div class="kt-container">
                        <div class="kt-footer__bottom">
                            <div class="kt-footer__copyright">
                                @lang('global.site.copyright')
                            </div>
                            <div class="kt-footer__menu">
                                <a href="{{ route('privacy-policy') }}" class="kt-link">@lang('front.pages.privacy-policy.link')</a>
                                <a href="{{ route('terms-of-service') }}" class="kt-link">@lang('front.pages.terms-of-service.link')</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end:: Footer -->
            </div>
        </div>
    </div>
    <!-- end:: Page -->

    <!-- begin::Scrolltop -->
    <div id="kt_scrolltop" class="kt-scrolltop">
        <i class="fa fa-arrow-up"></i>
    </div>
    <!-- end::Scrolltop -->

    <!-- begin::Global Config(global config for global JS sciprts) -->
    <script>
        var KTAppOptions = {
            "colors": {
                "state": {
                    "brand": "#5d78ff",
                    "light": "#ffffff",
                    "dark": "#282a3c",
                    "primary": "#5867dd",
                    "success": "#34bfa3",
                    "info": "#36a3f7",
                    "warning": "#ffb822",
                    "danger": "#fd3995"
                },
                "base": {
                    "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
                    "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
                }
            }
        };
    </script>
    <!-- end::Global Config -->

    <script src="{{ asset('theme/assets/vendors/general/popper.js/dist/umd/popper.js') }}" type="text/javascript"></script>

    {{-- <!--begin:: Global Mandatory Vendors -->
    <script src="{{ asset("theme/assets/vendors/general/jquery/dist/jquery.js") }}" type="text/javascript"></script>
    <script src="{{ asset("theme/assets/vendors/general/popper.js/dist/umd/popper.js") }}" type="text/javascript"></script>
    <script src="{{ asset("theme/assets/vendors/general/bootstrap/dist/js/bootstrap.min.js") }}" type="text/javascript"></script>
    <script src="{{ asset("theme/assets/vendors/general/js-cookie/src/js.cookie.js") }}" type="text/javascript"></script>
    <script src="{{ asset("theme/assets/vendors/general/moment/min/moment.min.js") }}" type="text/javascript"></script>
    <script src="{{ asset("theme/assets/vendors/general/tooltip.js/dist/umd/tooltip.min.js") }}" type="text/javascript"></script>
    <script src="{{ asset("theme/assets/vendors/general/perfect-scrollbar/dist/perfect-scrollbar.js") }}" type="text/javascript"></script>
    <script src="{{ asset("theme/assets/vendors/general/sticky-js/dist/sticky.min.js") }}" type="text/javascript"></script>
    <script src="{{ asset("theme/assets/vendors/general/wnumb/wNumb.js") }}" type="text/javascript"></script>
    <!--end:: Global Mandatory Vendors -->

    <!--begin:: Global Optional Vendors -->
    <script src="{{ asset("theme/assets/vendors/general/jquery-form/dist/jquery.form.min.js") }}" type="text/javascript"></script>
    <script src="{{ asset("theme/assets/vendors/general/block-ui/jquery.blockUI.js") }}" type="text/javascript"></script>
    <script src="{{ asset("theme/assets/vendors/general/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js") }}" type="text/javascript"></script>
    <script src="{{ asset("theme/assets/vendors/custom/components/vendors/bootstrap-datepicker/init.js") }}" type="text/javascript"></script>
    <script src="{{ asset("theme/assets/vendors/general/bootstrap-datetime-picker/js/bootstrap-datetimepicker.min.js") }}" type="text/javascript"></script>
    <script src="{{ asset("theme/assets/vendors/general/bootstrap-timepicker/js/bootstrap-timepicker.min.js") }}" type="text/javascript"></script>
    <script src="{{ asset("theme/assets/vendors/custom/components/vendors/bootstrap-timepicker/init.js") }}" type="text/javascript"></script>
    <script src="{{ asset("theme/assets/vendors/general/bootstrap-daterangepicker/daterangepicker.js") }}" type="text/javascript"></script>
    <script src="{{ asset("theme/assets/vendors/general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js") }}" type="text/javascript"></script>
    <script src="{{ asset("theme/assets/vendors/general/bootstrap-maxlength/src/bootstrap-maxlength.js") }}" type="text/javascript"></script>
    <script src="{{ asset("theme/assets/vendors/custom/vendors/bootstrap-multiselectsplitter/bootstrap-multiselectsplitter.min.js") }}" type="text/javascript"></script>
    <script src="{{ asset("theme/assets/vendors/general/bootstrap-select/dist/js/bootstrap-select.js") }}" type="text/javascript"></script>
    <script src="{{ asset("theme/assets/vendors/general/bootstrap-switch/dist/js/bootstrap-switch.js") }}" type="text/javascript"></script>
    <script src="{{ asset("theme/assets/vendors/custom/components/vendors/bootstrap-switch/init.js") }}" type="text/javascript"></script>
    <script src="{{ asset("theme/assets/vendors/general/select2/dist/js/select2.full.js") }}" type="text/javascript"></script>
    <script src="{{ asset("theme/assets/vendors/general/ion-rangeslider/js/ion.rangeSlider.js") }}" type="text/javascript"></script>
    <script src="{{ asset("theme/assets/vendors/general/typeahead.js/dist/typeahead.bundle.js") }}" type="text/javascript"></script>
    <script src="{{ asset("theme/assets/vendors/general/handlebars/dist/handlebars.js") }}" type="text/javascript"></script>
    <script src="{{ asset("theme/assets/vendors/general/inputmask/dist/jquery.inputmask.bundle.js") }}" type="text/javascript"></script>
    <script src="{{ asset("theme/assets/vendors/general/inputmask/dist/inputmask/inputmask.date.extensions.js") }}" type="text/javascript"></script>
    <script src="{{ asset("theme/assets/vendors/general/inputmask/dist/inputmask/inputmask.numeric.extensions.js") }}" type="text/javascript"></script>
    <script src="{{ asset("theme/assets/vendors/general/nouislider/distribute/nouislider.js") }}" type="text/javascript"></script>
    <script src="{{ asset("theme/assets/vendors/general/owl.carousel/dist/owl.carousel.js") }}" type="text/javascript"></script>
    <script src="{{ asset("theme/assets/vendors/general/autosize/dist/autosize.js") }}" type="text/javascript"></script>
    <script src="{{ asset("theme/assets/vendors/general/clipboard/dist/clipboard.min.js") }}" type="text/javascript"></script>
    <script src="{{ asset("theme/assets/vendors/general/dropzone/dist/dropzone.js") }}" type="text/javascript"></script>
    <script src="{{ asset("theme/assets/vendors/general/summernote/dist/summernote.js") }}" type="text/javascript"></script>
    <script src="{{ asset("theme/assets/vendors/general/markdown/lib/markdown.js") }}" type="text/javascript"></script>
    <script src="{{ asset("theme/assets/vendors/general/bootstrap-markdown/js/bootstrap-markdown.js") }}" type="text/javascript"></script>
    <script src="{{ asset("theme/assets/vendors/custom/components/vendors/bootstrap-markdown/init.js") }}" type="text/javascript"></script>
    <script src="{{ asset("theme/assets/vendors/general/bootstrap-notify/bootstrap-notify.min.js") }}" type="text/javascript"></script>
    <script src="{{ asset("theme/assets/vendors/custom/components/vendors/bootstrap-notify/init.js") }}" type="text/javascript"></script>
    <script src="{{ asset("theme/assets/vendors/general/jquery-validation/dist/jquery.validate.js") }}" type="text/javascript"></script>
    <script src="{{ asset("theme/assets/vendors/general/jquery-validation/dist/additional-methods.js") }}" type="text/javascript"></script>
    <script src="{{ asset("theme/assets/vendors/custom/components/vendors/jquery-validation/init.js") }}" type="text/javascript"></script>
    <script src="{{ asset("theme/assets/vendors/general/toastr/build/toastr.min.js") }}" type="text/javascript"></script>
    <script src="{{ asset("theme/assets/vendors/general/raphael/raphael.js") }}" type="text/javascript"></script>
    <script src="{{ asset("theme/assets/vendors/general/morris.js/morris.js") }}" type="text/javascript"></script>
    <script src="{{ asset("theme/assets/vendors/general/chart.js/dist/Chart.bundle.js") }}" type="text/javascript"></script>
    <script src="{{ asset("theme/assets/vendors/custom/vendors/bootstrap-session-timeout/dist/bootstrap-session-timeout.min.js") }}" type="text/javascript"></script>
    <script src="{{ asset("theme/assets/vendors/custom/vendors/jquery-idletimer/idle-timer.min.js") }}" type="text/javascript"></script>
    <script src="{{ asset("theme/assets/vendors/general/waypoints/lib/jquery.waypoints.js") }}" type="text/javascript"></script>
    <script src="{{ asset("theme/assets/vendors/general/counterup/jquery.counterup.js") }}" type="text/javascript"></script>
    <script src="{{ asset("theme/assets/vendors/general/es6-promise-polyfill/promise.min.js") }}" type="text/javascript"></script>
    <script src="{{ asset("theme/assets/vendors/general/sweetalert2/dist/sweetalert2.min.js") }}" type="text/javascript"></script>
    <script src="{{ asset("theme/assets/vendors/custom/components/vendors/sweetalert2/init.js") }}" type="text/javascript"></script>
    <script src="{{ asset("theme/assets/vendors/general/jquery.repeater/src/lib.js") }}" type="text/javascript"></script>
    <script src="{{ asset("theme/assets/vendors/general/jquery.repeater/src/jquery.input.js") }}" type="text/javascript"></script>
    <script src="{{ asset("theme/assets/vendors/general/jquery.repeater/src/repeater.js") }}" type="text/javascript"></script>
    <script src="{{ asset("theme/assets/vendors/general/dompurify/dist/purify.js") }}" type="text/javascript"></script>
    <!--end:: Global Optional Vendors -->

    <!--begin::Global Theme Bundle(used by all pages) -->
    <script src="{{ asset("theme/assets/demo/demo10/base/scripts.bundle.js") }}" type="text/javascript"></script>
    <!--end::Global Theme Bundle -->

    <!--begin::Page Vendors(used by this page) -->
    <script src="{{ asset("theme/assets/vendors/custom/fullcalendar/fullcalendar.bundle.js") }}" type="text/javascript"></script> --}}
    <script src="{{ asset("js/global-mandatory-option-vender.min.js") }}" type="text/javascript"></script>
    <script src="//maps.google.com/maps/api/js?key=AIzaSyBTGnKT7dt597vo9QgeQ7BFhvSRP4eiMSM" type="text/javascript"></script>
    {{-- <script src="{{ asset("theme/assets/vendors/custom/gmaps/gmaps.js") }}" type="text/javascript"></script>
    <!--end::Page Vendors -->

    <!--begin::Page Scripts(used by this page) -->
    <script src="{{ asset("theme/assets/app/custom/general/dashboard.js") }}" type="text/javascript"></script>
    <!--end::Page Scripts -->

    <!--begin::Global App Bundle(used by all pages) -->
    <script src="{{ asset("theme/assets/app/bundle/app.bundle.js") }}" type="text/javascript"></script>
    <!--end::Global App Bundle --> --}}
    <script src="{{ asset("js/combine-js-one.min.js") }}" type="text/javascript"></script>
@stop
