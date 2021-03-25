@extends('frontend.layouts.default')
@section('page_heading', trans('front.pages.results.title'))
@section('content')
    <div class="row">
        <table class="table table-bordered table-striped {{ count($assessments) > 0 ? 'datatable' : '' }} dt-select">
            <thead class="thead-dark">
            <tr>
                <th>@lang('global.respondents.fields.first_name')</th>
                <th>@lang('global.respondents.fields.last_name')</th>
                <th>@lang('global.respondents.fields.gender')</th>
                <th>@lang('global.respondents.fields.adult')</th>
                <th>@lang('global.respondents.fields.email')</th>
                <th>@lang('global.respondents.fields.phone')</th>
                <th>@lang('global.app.created_at')</th>
                <th>&nbsp;</th>
            </tr>
            </thead>

            <tbody>
            @if (count($assessments) > 0)
                @foreach ($assessments as $assessment)
                    <tr {{ $assessment->is_incomplete ? 'class=warning' : '' }}>
                        <td>{{ $assessment->respondent->first_name }}</td>
                        <td>{{ $assessment->respondent->last_name }}</td>
                        <td>{{ $assessment->respondent->gender }}</td>
                        <td>{{ $assessment->respondent->adult }}</td>
                        <td>{{ $assessment->respondent->email }}</td>
                        <td>{{ $assessment->respondent->phone }}</td>
                        <td>{{ $assessment->created_at }}</td>
                        <td>
                            <a href="{{ route('account.score', [$assessment->id]) }}" class="btn btn-sm btn-success">@lang('global.assessments.score')</a>
                            <a href="{{ route('account.answers', [$assessment->id]) }}" class="btn btn-sm btn-info">@lang('global.assessments.answers')</a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="9">@lang('global.app.no_entries_in_table')</td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
@stop
