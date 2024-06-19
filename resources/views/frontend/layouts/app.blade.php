<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>@lang('global.site.title')</title>
    <meta name="description" content="">
    <meta name="author" content="@lang('global.site.author')">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Fonts -->
    <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Poppins:300,400,500,600,700", "Asap+Condensed:500"]
            },
            active: function() {
                sessionStorage.fonts = true;
            }
        });
    </script>

    <!-- Icon -->
    <link rel="shortcut icon" href="{{ asset("images/favicon.png") }}" />
    <link rel="icon" href="{{ asset("images/favicon.png") }}" type="image/ico" />

    <!-- Mandatory vendors -->
    {{-- <link href="{{ asset("theme/assets/vendors/custom/fullcalendar/fullcalendar.bundle.css") }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("theme/assets/vendors/general/perfect-scrollbar/css/perfect-scrollbar.css") }}" rel="stylesheet" type="text/css" />

    <!-- Optional vendors -->
    <link href="{{ asset("theme/assets/vendors/general/tether/dist/css/tether.css") }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("theme/assets/vendors/general/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css") }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("theme/assets/vendors/general/bootstrap-datetime-picker/css/bootstrap-datetimepicker.css") }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("theme/assets/vendors/general/bootstrap-timepicker/css/bootstrap-timepicker.css") }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("theme/assets/vendors/general/bootstrap-daterangepicker/daterangepicker.css") }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("theme/assets/vendors/general/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.css") }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("theme/assets/vendors/general/bootstrap-select/dist/css/bootstrap-select.css") }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("theme/assets/vendors/general/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.css") }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("theme/assets/vendors/general/select2/dist/css/select2.css") }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("theme/assets/vendors/general/ion-rangeslider/css/ion.rangeSlider.css") }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("theme/assets/vendors/general/nouislider/distribute/nouislider.css") }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("theme/assets/vendors/general/owl.carousel/dist/assets/owl.carousel.css") }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("theme/assets/vendors/general/owl.carousel/dist/assets/owl.theme.default.css") }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("theme/assets/vendors/general/dropzone/dist/dropzone.css") }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("theme/assets/vendors/general/summernote/dist/summernote.css") }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("theme/assets/vendors/general/bootstrap-markdown/css/bootstrap-markdown.min.css") }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("theme/assets/vendors/general/animate.css/animate.css") }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("theme/assets/vendors/general/toastr/build/toastr.css") }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("theme/assets/vendors/general/morris.js/morris.css") }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("theme/assets/vendors/general/sweetalert2/dist/sweetalert2.css") }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("theme/assets/vendors/general/socicon/css/socicon.css") }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("theme/assets/vendors/custom/vendors/line-awesome/css/line-awesome.css") }}" rel="stylesheet" type="text/css" /> --}}

    <link href="{{ asset("css/app.blade.css")}}" rel="stylesheet" type="text/css" />

    <link href="{{ asset("theme/assets/vendors/custom/vendors/flaticon/flaticon.css") }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("theme/assets/vendors/custom/vendors/flaticon2/flaticon.css") }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("theme/assets/vendors/custom/vendors/fontawesome5/css/all.min.css") }}" rel="stylesheet" type="text/css" />

    <!-- Theme style -->
    <link href="{{ asset("theme/assets/demo/demo10/base/style.bundle.css") }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("theme/assets/app/custom/login/login-v3.demo10.css") }}" rel="stylesheet" type="text/css" />

    <!-- Custom style -->
    <link href="{{ asset("css/custom-styles.css") }}" rel="stylesheet" type="text/css" />
</head>
<body class="kt-page--fluid kt-page-content-white kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-page--loading">

@yield('body')

@yield('scripts')

</body>
</html>