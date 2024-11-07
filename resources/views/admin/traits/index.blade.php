@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.traits.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @if (count($traits))
                @lang('global.app.list_entries', ['count' => count($traits)])
            @else
                @lang('global.app.list')
            @endif
            <div  style="float: right;">
                <a class="btn btn-primary" href="{{ route('admin.traits.create') }}">

                    Create Trait
                </a>
            </div>
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped {{ count($traits) ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        <th style="text-align:center"><input type="checkbox" id="select-all" /></th>
                        <th>@lang('global.traits.fields.number')</th>
                        <th>@lang('global.traits.fields.key')</th>
                        <th>@lang('global.traits.fields.trait')</th>
                        {{-- <th>Action</th> --}}
                    </tr>
                </thead>

                <tbody>
                    @if (count($traits))
                        @foreach ($traits as $trait)
                            <tr data-entry-id="{{ $trait->id }}">
                                <td></td>
                                <td>{{ $trait->number }}</td>
                                <td>{{ $trait->key }}</td>
                                <td>{{ $trait->trait }}</td>
                                {{-- <td>
                                    <a href="{{ route('admin.traits.edit', $trait->id) }}" class="btn btn-xs btn-info">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.traits.destroy', $trait->id) }}" method="POST" style="display:inline-block;" >
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td> --}}
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
