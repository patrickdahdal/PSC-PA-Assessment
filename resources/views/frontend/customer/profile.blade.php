@extends('frontend.layouts.default')
@section('page_heading', trans('front.pages.profile.title'))
@section('content')
    <div class="row">
        <div class="col-xl-10">
            <h4><small class="kt-font-primary">@lang('global.customers.fields.company_name')</small><br>
                {{ $customer->company_name }}</h4><br>

            <h4><small class="kt-font-primary">@lang('global.customers.fields.full_name')</small><br>
                {{ $customer->first_name }} {{ $customer->last_name }}</h4><br>

            <h4><small class="kt-font-primary">@lang('global.customers.fields.title')</small><br>
                {{ $customer->title }}</h4><br>

            <h4><small class="kt-font-primary">@lang('global.customers.fields.email')</small><br>
                {{ $customer->email }}</h4><br>

            <h4><small class="kt-font-primary">@lang('global.customers.fields.phone')</small><br>
                {{ $customer->phone }}</h4><br>

            <h4><small class="kt-font-primary">@lang('global.customers.fields.created_at')</small><br>
                {{ $customer->created_at->format('d F Y') }}</h4><br>

            <h4><small class="kt-font-primary">@lang('global.customers.fields.membercode')</small><br>
                {{ $customer->membercode->membercode }}</h4>
        </div>
    </div>
@stop
