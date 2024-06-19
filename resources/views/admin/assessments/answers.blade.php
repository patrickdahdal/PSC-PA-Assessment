@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.assessments.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            <p>@lang('global.assessments.answers')</p>
            <p><a href="{{ route('admin.assessments.index') }}" class="btn btn-primary">@lang('global.app.back_to_list')</a> &nbsp;
                <a href="{{ route('admin.assessments.score', ['id' => $assessment->id]) }}" class="btn btn-success">@lang('global.assessments.score')</a></p>
        </div>

        <div class="panel-body">
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

            <h4>@lang('global.assessments.test_answers')</h4>
            <div class="row">
                <br>
                <table class="table table-condensed table-hover" id="test-answers">
                    <tbody>
                    @foreach ($answers as $a)
                        @php
                            $is_sub_row = $a->question->number % 15 == 1 ? 1 : 0;
                        @endphp

                        @if ($is_sub_row)
                            <tr class="sub-row">
                                <td></td>
                                <td>Y</td>
                                <td>+</td>
                                <td>M</td>
                                <td>-</td>
                                <td>N</td>
                                <td></td>
                            </tr>
                        @endif

                        <tr class="que-row">
                            <td class="first">{{ $a->question->number }}</td>
                            <td>@if ($a->answer->answer == 'Y') {!! "&check;" !!} @endif</td>
                            <td>@if ($a->answer->answer == '+') {!! "&check;" !!} @endif</td>
                            <td>@if ($a->answer->answer == 'M') {!! "&check;" !!} @endif</td>
                            <td>@if ($a->answer->answer == '-') {!! "&check;" !!} @endif</td>
                            <td>@if ($a->answer->answer == 'N') {!! "&check;" !!} @endif</td>
                            <td class="last">{{ $a->question->question }}</td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>

        <div class="panel-heading">
            <p><a href="{{ route('admin.assessments.index') }}" class="btn btn-primary">@lang('global.app.back_to_list')</a> &nbsp;
                <a href="{{ route('admin.assessments.score', ['id' => $assessment->id]) }}" class="btn btn-success">@lang('global.assessments.score')</a></p>
        </div>
    </div>
@stop
