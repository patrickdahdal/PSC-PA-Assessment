@extends('frontend.layouts.default')
@section('page_heading', trans('front.pages.verify.title'))
@section('content')
    <div class="col-xl-10">
        {!! Form::open(['method' => 'POST', 'route' => ['test.verify.submit']]) !!}

        <div class="row">
            <div class="col-md-6 alert alert-info" role="alert">
                {{ trans('front.pages.verify.descr') }}
            </div>
        </div>

        <div class="row">
            <div class="col-md-3 form-group">
                {!! Form::label('membercode', trans('front.test.membercode'), ['class' => 'control-label']) !!}
            </div>
            <div class="col-md-3 form-group">
                {!! Form::text('membercode', old('membercode'), ['class' => 'form-control', 'size' => 20, 'maxlength' => 16]) !!}
            </div>
            <div class="col-md-6 form-group">
                &nbsp;
            </div>
        </div>

        <div class="row">
            <div class="col-md-3 form-group">
                {!! Form::label('email', trans('front.test.email'), ['class' => 'control-label']) !!}
            </div>
            <div class="col-md-3 form-group">
                {!! Form::email('email', old('email'), ['class' => 'form-control', 'required' => '']) !!}
            </div>
            <div class="col-md-6 form-group">
                &nbsp;
            </div>
        </div>

        <div class="row">
            <div class="col-md-3 form-group">
                &nbsp;
            </div>
            <div class="col-md-9 form-group">
                {!! Form::submit(trans('front.test.submit_proceed'), ['class' => 'btn btn-primary']) !!}
            </div>
        </div>

        {!! Form::close() !!}
    </div>
@stop