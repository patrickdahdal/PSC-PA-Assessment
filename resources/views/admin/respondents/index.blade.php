@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.respondents.title')</h3>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="panel panel-default">
        <div class="panel-heading">
            @if (count($respondents))
                @lang('global.app.list_entries', ['count' => count($respondents)])
            @else
                @lang('global.app.list')
            @endif
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($respondents) ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        <th style="text-align:center"><input type="checkbox" id="select-all" /></th>
                        <th>ID</th>
                        <th>@lang('global.respondents.fields.full_name')</th>
                        <th>@lang('global.customers.fields.company_name')</th>
                        <th>@lang('global.respondents.fields.membercode')</th>
                        <th>@lang('global.respondents.fields.gender')</th>
                        <th>@lang('global.respondents.fields.adult')</th>
                        <th>@lang('global.respondents.fields.email')</th>
                        <th>@lang('global.respondents.fields.phone')</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>

                <tbody>
                    @if (count($respondents))
                        @foreach ($respondents as $respondent)
                            <tr data-entry-id="{{ $respondent->id }}">
                                <td></td>
                                <td style="text-align:center"><a href="{{ route('admin.respondents.show', [$respondent->id]) }}">{{ $respondent->id }}</a></td>
                                <td><a href="{{ route('admin.respondents.show', [$respondent->id]) }}">{{ $respondent->first_name }} {{ $respondent->last_name }}</a></td>
                                <td><a href="{{ route('admin.customers.show', [$respondent->membercode->customer_id]) }}">{{ $respondent->membercode->customer->company_name }}</a></td>
                                <td>{{ $respondent->membercode->membercode }}</td>
                                <td>{{ $respondent->gender }}</td>
                                <td>{{ $respondent->adult }}</td>
                                <td>{{ $respondent->email }}</td>
                                <td>{{ $respondent->phone }}</td>
                                <td>
                                    <a href="{{ route('admin.respondents.show', [$respondent->id]) }}" class="btn btn-xs btn-primary">@lang('global.app.view')</a>
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
    </div>
@stop
