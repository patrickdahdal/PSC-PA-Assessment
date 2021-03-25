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
        {{-- <div class="panel-heading">
            @if (count($respondents))
                @lang('global.app.list_entries', ['count' => count($respondents)])
            @else
                @lang('global.app.list')
            @endif
        </div> --}}

        <div class="panel-body table-responsive">
            {{-- <table class="table table-bordered table-striped {{ count($respondents) ? 'respondent-datatable' : '' }} dt-select"> --}}
            <table id="respondent-datatable" class="table table-bordered table-striped dt-select">
                <thead>
                    <tr>
                        <th style="text-align:center">No</th>
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
                </tbody>
            </table>
        </div>
        
    </div>
@stop

@section('javascript')
<script>
$(document).ready(function() {
    $('#respondent-datatable').DataTable({        
        processing: true,
        serverSide: true,
        pageLength: 50,
        ajax: "{{ route('admin.respondents.index') }}",
        columns: [
            {data: 'DT_RowIndex', searchable: false, orderable: false},
            {data: 'id'},
            {data: 'full_name'},
            {data: 'company_name'},
            {data: 'member_code'},            
            {data: 'gender'},
            {data: 'adult'},
            {data: 'email'},
            {data: 'phone'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
});
} );
</script>
@stop