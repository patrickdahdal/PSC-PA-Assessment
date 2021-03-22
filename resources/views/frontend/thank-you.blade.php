@extends('frontend.layouts.default')
@section('page_heading', trans('front.pages.thank-you.title'))
@section('content')
    <div class="row">
        <div class="col-md-10 alert alert-success" role="alert">
            <ul style="list-style-type: none; font-size: 120%;">
                <li>{{ trans('front.pages.thank-you.descr') }}</li>
                <li>{{ trans('front.test.thank_you') }}</li>
            </ul>
        </div>
    </div>
@stop