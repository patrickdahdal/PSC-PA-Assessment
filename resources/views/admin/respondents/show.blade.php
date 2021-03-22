@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.respondents.title')</h3>
    
    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app.view')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-sm-12 form-group">
                    <div class="col-sm-4">
                        @lang('global.respondents.fields.membercode')
                    </div>
                    <div class="col-sm-8">
                        {{ $respondent->membercode->membercode }}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 form-group">
                    <div class="col-sm-4">
                        @lang('global.respondents.fields.first_name')
                    </div>
                    <div class="col-sm-8">
                        {{ $respondent->first_name }}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 form-group">
                    <div class="col-sm-4">
                        @lang('global.respondents.fields.last_name')
                    </div>
                    <div class="col-sm-8">
                        {{ $respondent->last_name }}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 form-group">
                    <div class="col-sm-4">
                        @lang('global.respondents.fields.gender')
                    </div>
                    <div class="col-sm-8">
                        {{ $respondent->gender }}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 form-group">
                    <div class="col-sm-4">
                        @lang('global.respondents.fields.adult')
                    </div>
                    <div class="col-sm-8">
                        {{ $respondent->adult }}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 form-group">
                    <div class="col-sm-4">
                        @lang('global.respondents.fields.email')
                    </div>
                    <div class="col-sm-8">
                        {{ $respondent->email }}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 form-group">
                    <div class="col-sm-4">
                        @lang('global.respondents.fields.phone')
                    </div>
                    <div class="col-sm-8">
                        {{ $respondent->phone }}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 form-group">
                    <div class="col-sm-4">
                        @lang('global.respondents.fields.best_reached')
                    </div>
                    <div class="col-sm-8">
                        {{ $respondent->best_reached }}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 form-group">
                    <div class="col-sm-4">
                        @lang('global.respondents.fields.remark')
                    </div>
                    <div class="col-sm-8">
                        {{ $respondent->remark }}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 form-group">
                    <a href="{{ route('admin.respondents.index') }}" class="btn btn-primary">@lang('global.app.back_to_list')</a>
                </div>
            </div>

        </div>
    </div>

@stop

