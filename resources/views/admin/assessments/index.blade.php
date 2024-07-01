@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <div class="title-wrapper" style="display: flex; align-items: center; margin: 10px 0">
        <h3 class="page-title" style="margin: 0">@lang('global.assessments.title')</h3>
        <div class="alert alert-danger" role="alert" style="margin-left: auto; margin-bottom: 0">
            REMINDER ASSESSMENTS WILL 
            DELETED AFTER 90 DAYS.
        </div>          
    </div>
    

    <div class="panel panel-default">
        {{-- <div class="panel-heading">
            @if (count($assessments))
                @lang('global.app.list_entries', ['count' => count($assessments)])
            @else
                @lang('global.app.list')
            @endif           
        </div> --}}

        <div class="panel-body table-responsive">
            <table id="assessment-datatable" class="table table-bordered table-striped dt-select">
                <thead>
                    <tr>
                        <th style="text-align:center">No</th>
                        <th>ID</th>
                        <th>@lang('global.assessments.fields.respondent')</th>
                        <th>@lang('global.customers.fields.company_name')</th>
                        <th>@lang('global.respondents.fields.membercode')</th>
                        <th>@lang('global.respondents.fields.gender')</th>
                        <th>@lang('global.respondents.fields.adult')</th>
                        <th>@lang('global.app.created_at')</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>

                <tbody>
                    {{-- @if (count($assessments))
                        @foreach ($assessments as $assessment)
                            <tr data-entry-id="{{ $assessment->id }}" {{ $assessment->is_incomplete ? 'class=danger' : '' }}>
                                <td></td>
                                <td style="text-align:center"><a href="{{ route('admin.assessments.score', [$assessment->id]) }}">{{ $assessment->id }}</a></td>
                                <td>
                                    <a href="{{ route('admin.respondents.show', [$assessment->respondent->id]) }}">
                                        {{ $assessment->respondent->first_name }} {{ $assessment->respondent->last_name }}</a>
                                </td>
                                <td>
                                    <a href="{{ route('admin.customers.show', [$assessment->respondent->membercode->customer_id]) }}">
                                        {{ $assessment->respondent->membercode->customer->company_name }}</a>
                                </td>
                                <td>{{ $assessment->respondent->membercode->membercode }}</td>
                                <td>{{ $assessment->respondent->gender }}</td>
                                <td>{{ $assessment->respondent->adult }}</td>
                                <td>{{ $assessment->created_at }}</td>
                                <td>
                                    <a href="{{ route('admin.assessments.score', [$assessment->id]) }}" class="btn btn-xs btn-success">@lang('global.assessments.score')</a>
                                    <a href="{{ route('admin.assessments.answers', [$assessment->id]) }}" class="btn btn-xs btn-info">@lang('global.assessments.answers')</a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="9">@lang('global.app.no_entries_in_table')</td>
                        </tr>
                    @endif --}}
                </tbody>
            </table>
        </div>
    </div>
@stop
@section('javascript')
<script>
$(document).ready(function() {
    $('#assessment-datatable').DataTable({
        processing: true,
        serverSide: true,
        pageLength: 50,
        ajax: "{{ route('admin.assessments.index') }}",
        columns: [
            {data: 'DT_RowIndex', searchable: false, orderable: false},
            {data: 'id'},
            {data: 'full_name'},
            {data: 'company_name'},
            {data: 'member_code'},
            {data: 'gender'},
            {data: 'adult'},
            {data: 'created_at'},
            {data: 'action', searchable: false, orderable: false}
        ],
        createdRow: (row, data, dataIndex, cells) => {
            if (data.incomplete) $(row).addClass('danger');            
        }
    } );
} );
</script>
@stop
