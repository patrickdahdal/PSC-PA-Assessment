@extends('frontend.layouts.default')
@section('page_heading', trans('front.pages.membercode.title'))
@section('content')
    <div class="col-xl-10">
        {!! Form::open(['method' => 'POST', 'route' => ['membercode.save']]) !!}

        <div class="row">
            <div class="col-md-2 form-group">
                {!! Form::text('membercode', old('membercode'), ['class' => 'form-control', 'placeholder' => trans('front.test.membercode_placeholder'), 'size' => 20, 'maxlength' => 16]) !!}
            </div>
            <div class="col-md-10 form-group">
                {!! Form::submit(trans('front.test.submit_next'), ['class' => 'btn btn-primary']) !!}
            </div>
        </div>

        {!! Form::close() !!}
    </div>
@stop