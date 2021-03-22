@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.customers.title')</h3>
    
    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app.view')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-sm-12 form-group">
                    <div class="col-sm-4">
                        @lang('global.customers.fields.company_name')
                    </div>
                    <div class="col-sm-8">
                        {{ $customer->company_name }}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 form-group">
                    <div class="col-sm-4">
                        @lang('global.customers.fields.first_name')
                    </div>
                    <div class="col-sm-8">
                        {{ $customer->first_name }}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 form-group">
                    <div class="col-sm-4">
                        @lang('global.customers.fields.last_name')
                    </div>
                    <div class="col-sm-8">
                        {{ $customer->last_name }}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 form-group">
                    <div class="col-sm-4">
                        @lang('global.customers.fields.title')
                    </div>
                    <div class="col-sm-8">
                        {{ $customer->title }}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 form-group">
                    <div class="col-sm-4">
                        @lang('global.customers.fields.email')
                    </div>
                    <div class="col-sm-8">
                        {{ $customer->email }}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 form-group">
                    <div class="col-sm-4">
                        @lang('global.customers.fields.phone')
                    </div>
                    <div class="col-sm-8">
                        {{ $customer->phone }}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 form-group">
                    <div class="col-sm-4">
                        @lang('global.customers.fields.membercode')
                    </div>
                    <div class="col-sm-8">
                        @if ($customer->membercode)
                            {{ $customer->membercode->membercode }}
                        @else
                            @lang('global.app.not_available')
                        @endif
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 form-group">
                    <div class="col-sm-4">
                        @lang('global.customers.fields.active')
                    </div>
                    <div class="col-sm-8">
                        {{ $customer->active ? 'Yes' : 'No' }}
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 form-group">
                    <br>
                    <a href="{{ route('admin.customers.index') }}" class="btn btn-primary">@lang('global.app.back_to_list')</a> &nbsp;
                    <a href="{{ route('admin.customers.edit',[$customer->id]) }}" class="btn btn-warning">@lang('global.app.edit')</a> &nbsp;
                    {!! Form::open(array(
                        'style' => 'display: inline-block;',
                        'method' => 'DELETE',
                        'onsubmit' => "return confirm('".trans("global.app.are_you_sure")."');",
                        'route' => ['admin.customers.destroy', $customer->id])) !!}
                    {!! Form::submit(trans('global.app.delete'), array('class' => 'btn btn-danger')) !!}
                    {!! Form::close() !!}
                </div>
            </div>

        </div>
    </div>

@stop

