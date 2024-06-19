@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.answers.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @if (count($answers))
                @lang('global.app.list_entries', ['count' => count($answers)])
            @else
                @lang('global.app.list')
            @endif
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($answers) ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        <th style="text-align:center"><input type="checkbox" id="select-all" /></th>
                        <th>@lang('global.answers.fields.number')</th>
                        <th>@lang('global.answers.fields.answer')</th>
                    </tr>
                </thead>

                <tbody>
                    @if (count($answers))
                        @foreach ($answers as $answer)
                            <tr data-entry-id="{{ $answer->id }}">
                                <td></td>
                                <td>{{ $answer->number }}</td>
                                <td>{{ $answer->answer }}</td>
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
