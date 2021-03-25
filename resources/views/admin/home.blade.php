@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.app.dashboard')</h3>

    <div class="col-md-12" id="dashboard">
        <div class="panel panel-default">
            <div class="panel-heading">@lang('global.customers.title')</div>
            <div class="panel-body">
                <div class="col-sm-3">
                    <a href="{{ route('admin.customers.index') }}">
                        <i class="fa fa-address-card">&nbsp;</i>
                        <span class="title">@lang('global.customers.title')</span>
                    </a>
                </div>
                <div class="col-sm-9">
                    <a href="{{ route('admin.respondents.index') }}">
                        <i class="fa fa-users">&nbsp;</i>
                        <span class="title">@lang('global.respondents.title')</span>
                    </a>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading">@lang('global.assessments.title')</div>
            <div class="panel-body">
                <div class="col-sm-3">
                    <a href="{{ route('admin.assessments.index') }}">
                        <i class="fa fa-bar-chart">&nbsp;</i>
                        <span class="title">@lang('global.assessments.title')</span>
                    </a>
                </div>
                <div class="col-sm-3">
                    <a href="{{ route('admin.questions.index') }}">
                        <i class="fa fa-question">&nbsp;</i>
                        <span class="title">@lang('global.questions.title')</span>
                    </a>
                </div>
                <div class="col-sm-3">
                    <a href="{{ route('admin.questions.answers') }}">
                        <i class="fa fa-check">&nbsp;</i>
                        <span class="title">@lang('global.answers.title')</span>
                    </a>
                </div>
                <div class="col-sm-3">
                    <a href="{{ route('admin.traits.index') }}">
                        <i class="fa fa-star">&nbsp;</i>
                        <span class="title">@lang('global.traits.title')</span>
                    </a>
                </div>
            </div>
        </div>

        @can('users_manage')
        <div class="panel panel-default">
            <div class="panel-heading">@lang('global.user-management.title')</div>
            <div class="panel-body">
                <div class="col-sm-3">
                    <a href="{{ route('admin.permissions.index') }}">
                        <i class="fa fa-check-square">&nbsp;</i>
                        <span class="title">@lang('global.permissions.title')</span>
                    </a>
                </div>
                <div class="col-sm-3">
                    <a href="{{ route('admin.roles.index') }}">
                        <i class="fa fa-user-secret">&nbsp;</i>
                        <span class="title">@lang('global.roles.title')</span>
                    </a>
                </div>
                <div class="col-sm-6">
                    <a href="{{ route('admin.users.index') }}">
                        <i class="fa fa-user">&nbsp;</i>
                        <span class="title">@lang('global.users.title')</span>
                    </a>
                </div>
            </div>
        </div>
        @endcan

    </div>
@endsection
