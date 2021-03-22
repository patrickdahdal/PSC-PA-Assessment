@extends('frontend.layouts.default')
@section('page_heading', trans('global.assessments.answers'))
@section('content')
    <div class="row">
        <div class="form-group">
            <a href="{{ route('account.index') }}" class="btn btn-primary">
                <i class="fa flaticon2-fast-back"></i> @lang('global.app.back_to_list')</a>
            <a href="{{ route('account.score', ['id' => $assessment->id]) }}" class="btn btn-success">
                <i class="fa flaticon-graphic-2"></i> @lang('global.assessments.score')</a>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-10 form-group">
            <h4>{{ $assessment->respondent->first_name }} {{ $assessment->respondent->last_name }}</h4>

            <h5><small class="text-muted">@lang('global.respondents.fields.gender')</small> &nbsp; &nbsp; &nbsp;
                {{ $assessment->respondent->gender }}</h5>

            <h5><small class="text-muted">@lang('global.respondents.fields.adult')</small> &nbsp;
                {{ $assessment->respondent->adult }}</h5>
        </div>
    </div>

    <h4>@lang('global.assessments.test_answers')</h4>
    <div class="row">
        <br>
        <table class="table table-condensed table-hover">
            <tbody>
            @foreach ($answers as $a)
                @php
                    $is_sub_row = $a->question->number % 15 == 1 ? 1 : 0;
                @endphp

                @if ($is_sub_row)
                    <tr style="color: #6c7293; background-color: #ebedf2; border-color: #ebedf2; font-weight: bold;">
                        <td></td>
                        <td>Y</td>
                        <td>+</td>
                        <td>M</td>
                        <td>-</td>
                        <td>N</td>
                        <td></td>
                    </tr>
                @endif

                <tr>
                    <td>{{ $a->question->number }}</td>
                    <td>@if ($a->answer->answer == 'Y') {!! "&check;" !!} @endif</td>
                    <td>@if ($a->answer->answer == '+') {!! "&check;" !!} @endif</td>
                    <td>@if ($a->answer->answer == 'M') {!! "&check;" !!} @endif</td>
                    <td>@if ($a->answer->answer == '-') {!! "&check;" !!} @endif</td>
                    <td>@if ($a->answer->answer == 'N') {!! "&check;" !!} @endif</td>
                    <td>{{ $a->question->question }}</td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>

    <div class="row">
        <div class="form-group">
            <a href="{{ route('account.index') }}" class="btn btn-primary">
                <i class="fa flaticon2-fast-back"></i> @lang('global.app.back_to_list')</a>
            <a href="{{ route('account.score', ['id' => $assessment->id]) }}" class="btn btn-success">
                <i class="fa flaticon-graphic-2"></i> @lang('global.assessments.score')</a>
        </div>
    </div>
@stop

