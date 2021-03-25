@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.customers.title')</h3>

    {!! Form::model($customer, ['method' => 'PUT', 'route' => ['admin.customers.update', $customer->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app.edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-sm-6 form-group">
                    {!! Form::label('company_name', trans('global.customers.fields.company_name'), ['class' => 'control-label']) !!}
                    {!! Form::text('company_name', old('company_name'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    @if ($errors->has('company_name'))
                        <p class="help-block alert-danger">
                            {{ $errors->first('company_name') }}
                        </p>
                    @endif
                </div>

                <div class="col-sm-6 form-group">
                    @php
                        $membercode = $customer->membercode ? $customer->membercode->membercode : null;
                    @endphp
                    {!! Form::label('membercode', trans('global.customers.fields.membercode'), ['class' => 'control-label']) !!}
                    {!! Form::text('membercode', $membercode, ['class' => 'form-control', 'placeholder' => '']) !!}
                    @if ($errors->has('membercode'))
                        <p class="help-block alert-danger">
                            {{ $errors->first('membercode') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6 form-group">
                    {!! Form::label('first_name', trans('global.customers.fields.first_name'), ['class' => 'control-label']) !!}
                    {!! Form::text('first_name', old('first_name'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    @if ($errors->has('first_name'))
                        <p class="help-block alert-danger">
                            {{ $errors->first('first_name') }}
                        </p>
                    @endif
                </div>

                <div class="col-sm-6 form-group">
                    {!! Form::label('email', trans('global.customers.fields.email'), ['class' => 'control-label']) !!}
                    {!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => '', 'required' => '']) !!}
                    @if ($errors->has('email'))
                        <p class="help-block alert-danger">
                            {{ $errors->first('email') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6 form-group">
                    {!! Form::label('last_name', trans('global.customers.fields.last_name'), ['class' => 'control-label']) !!}
                    {!! Form::text('last_name', old('last_name'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    @if ($errors->has('last_name'))
                        <p class="help-block alert-danger">
                            {{ $errors->first('last_name') }}
                        </p>
                    @endif
                </div>

                <div class="col-sm-6 form-group">
                    {!! Form::label('password', trans('global.customers.fields.password'), ['class' => 'control-label']) !!}
                    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => '']) !!}
                    @if ($errors->has('password'))
                        <p class="help-block alert-danger">
                            {{ $errors->first('password') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6 form-group">
                    {!! Form::label('title', trans('global.customers.fields.title'), ['class' => 'control-label']) !!}
                    {!! Form::text('title', old('title'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    @if ($errors->has('title'))
                        <p class="help-block alert-danger">
                            {{ $errors->first('title') }}
                        </p>
                    @endif
                </div>

                <div class="col-sm-6 form-group">
                    {!! Form::label('password_confirmation', trans('global.customers.fields.password_confirmation'), ['class' => 'control-label']) !!}
                    {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => '']) !!}
                    @if ($errors->has('password_confirmation'))
                        <p class="help-block alert-danger">
                            {{ $errors->first('password_confirmation') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6 form-group">
                    {!! Form::label('phone', trans('global.customers.fields.phone'), ['class' => 'control-label']) !!}
                    {!! Form::text('phone', old('phone'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    @if ($errors->has('phone'))
                        <p class="help-block alert-danger">
                            {{ $errors->first('phone') }}
                        </p>
                    @endif
                </div>

                <div class="col-sm-6 form-group">
                    {!! Form::checkbox('active', 1, old('active')) !!} &nbsp;
                    {!! Form::label('active', trans('global.customers.fields.active'), ['class' => 'control-label']) !!}
                    @if ($errors->has('active'))
                        <p class="help-block alert-danger">
                            {{ $errors->first('active') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 form-group">
                    <br>
                    {!! Form::submit(trans('global.app.update'), ['class' => 'btn btn-warning']) !!} &nbsp;
                    <a href="{{ route('admin.customers.show', [$customer->id]) }}" class="btn btn-default">@lang('global.app.cancel')</a>
                </div>
            </div>

        </div>
    </div>

    {!! Form::close() !!}
@stop

