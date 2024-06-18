@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.customers.title')</h3>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <p>
        <a href="{{ route('admin.customers.create') }}" class="btn btn-success">@lang('global.app.add_new')</a>
    </p>

    <div class="panel panel-default">
        <div class="panel-heading">
            @if (count($customers))
                @lang('global.app.list_entries', ['count' => count($customers)])
            @else
                @lang('global.app.list')
            @endif
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($customers) ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        <th style="text-align:center"><input type="checkbox" id="select-all" /></th>
                        <th>ID</th>
                        <th>@lang('global.customers.fields.company_name')</th>
                        <th>@lang('global.customers.fields.first_name')</th>
                        <th>@lang('global.customers.fields.last_name')</th>
                        <th>@lang('global.customers.fields.title')</th>
                        <th>@lang('global.customers.fields.email')</th>
                        <th>@lang('global.customers.fields.phone')</th>
                        <th>@lang('global.customers.fields.membercode')</th>
                        <th>@lang('global.customers.fields.active')</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($customers))
                        @foreach ($customers as $customer)
                            <tr data-entry-id="{{ $customer->id }}">
                                <td></td>
                                <td style="text-align:center"><a href="{{ url("/admin/customers/{$customer->id}") }}">{{ $customer->id }}</a></td>
                                <td><a href="{{ url("/admin/customers/{$customer->id}") }}">{{ $customer->company_name }}</a></td>
                                <td>{{ $customer->first_name }}</td>
                                <td>{{ $customer->last_name }}</td>
                                <td>{{ $customer->title }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>{{ $customer->phone }}</td>
                                <td>
                                    @if ($customer->membercode)
                                        {{ $customer->membercode->membercode }}
                                    @else
                                        @lang('global.app.not_available')
                                    @endif
                                </td>
                                <td>{{ $customer->active ? 'Yes' : 'No' }}</td>
                                <td>
                                    <a href="{{ route('admin.customers.show', [$customer->id]) }}" class="btn btn-xs btn-primary">@lang('global.app.view')</a>
                                    <a href="{{ route('admin.customers.edit', [$customer->id]) }}" class="btn btn-xs btn-warning">@lang('global.app.edit')</a>
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
@section('javascript') 
    <script>
        window.route_mass_crud_entries_destroy = '{{ route('admin.customers.mass_destroy') }}';
    </script>
@endsection