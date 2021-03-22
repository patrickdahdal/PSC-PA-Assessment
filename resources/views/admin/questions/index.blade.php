@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.questions.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @if (count($questions))
                @lang('global.app.list_entries', ['count' => count($questions)])
            @else
                @lang('global.app.list')
            @endif
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($questions) ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        <th style="text-align:center"><input type="checkbox" id="select-all" /></th>
                        <th>@lang('global.questions.fields.number')</th>
                        <th>@lang('global.questions.fields.question')</th>
                        <th>@lang('global.questions.fields.group')</th>
                    </tr>
                </thead>

                <tbody>
                    @if (count($questions))
                        @foreach ($questions as $question)
                            <tr data-entry-id="{{ $question->id }}">
                                <td></td>
                                <td>{{ $question->number }}</td>
                                <td>{{ $question->question }}</td>
                                <td>{{ $question->group }}</td>
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
