@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.assessments.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            <p>@lang('global.assessments.score')</p>
            <p><a href="{{ route('admin.assessments.index') }}" class="btn btn-primary">@lang('global.app.back_to_list')</a> &nbsp;
                <a href="{{ route('admin.assessments.answers', ['id' => $assessment->id]) }}" class="btn btn-info">@lang('global.assessments.answers')</a> &nbsp;
                <a href="#" class="btn btn-default print-link">@lang('global.app.print')</a></p>
        </div>

        <div class="panel-body" id="test-results">
            <div class="row">
                <div class="col-sm-12 form-group">
                    <div class="col-sm-2">
                        @lang('global.respondents.fields.full_name')
                    </div>
                    <div class="col-sm-10">
                        <a href="{{ route('admin.respondents.show', [$assessment->respondent->id]) }}">
                            {{ $assessment->respondent->first_name }} {{ $assessment->respondent->last_name }}</a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 form-group">
                    <div class="col-sm-2">
                        @lang('global.respondents.fields.gender')
                    </div>
                    <div class="col-sm-10">
                        {{ $assessment->respondent->gender }}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 form-group">
                    <div class="col-sm-2">
                        @lang('global.respondents.fields.adult')
                    </div>
                    <div class="col-sm-10">
                        {{ $assessment->respondent->adult }}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 form-group">
                    <div class="col-sm-2">
                        @lang('global.respondents.fields.membercode')
                    </div>
                    <div class="col-sm-10">
                        {{ $assessment->respondent->membercode->membercode }}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 form-group">
                    <div class="col-sm-2">
                        @lang('global.customers.fields.company_name')
                    </div>
                    <div class="col-sm-10">
                        <a href="{{ route('admin.customers.show', [$assessment->respondent->membercode->customer_id]) }}">
                            {{ $assessment->respondent->membercode->customer->company_name }}</a>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <h4>@lang('global.assessments.test_results')</h4>
                    {!! $html_content !!}
                </div>
            </div>
        </div>

        <div class="panel-heading">
            <p><a href="{{ route('admin.assessments.index') }}" class="btn btn-primary">@lang('global.app.back_to_list')</a> &nbsp;
                <a href="{{ route('admin.assessments.answers', ['id' => $assessment->id]) }}" class="btn btn-info">@lang('global.assessments.answers')</a> &nbsp;
                <a href="#" class="btn btn-default print-link">@lang('global.app.print')</a></p>
        </div>
    </div>
@stop

@section('javascript')
    <script type="text/javascript">
        $(document).ready(function() {
            $("a.print-link").click(function() {
                var originalContents = document.body.innerHTML;
                var printContents = document.getElementById('test-results').innerHTML;

                $("body").html(printContents);
                $("body").css({"padding-top":"0"});
                $("body").css({"display":"block"});
                $("body").css({"position":"static"});

                window.print();

                return false;
            });
        });
    </script>
@stop
