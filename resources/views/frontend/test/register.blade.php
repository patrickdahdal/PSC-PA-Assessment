@extends('frontend.layouts.default')
@section('page_heading', trans('front.pages.register.title'))
@section('content')
    <div class="col-xl-8">
        {!! Form::open(['method' => 'POST', 'route' => ['register.save']]) !!}

        <div class="row">
            <div class="col-md-3 form-group">
                {!! Form::label('membercode_id', trans('front.test.membercode'), ['class' => 'control-label']) !!}
            </div>
            <div class="col-md-5 form-group">
                <strong>{{ $membercode->membercode }}</strong>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3 form-group">
                {!! Form::label('first_name', trans('front.test.first_name'), ['class' => 'control-label']) !!}
            </div>
            <div class="col-md-5 form-group">
                {!! Form::text('first_name', old('first_name'), ['class' => 'form-control', 'required' => '']) !!}
                @if ($errors->has('first_name'))
                    <p class="help-block alert-danger">
                        {{ $errors->first('first_name') }}
                    </p>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-md-3 form-group">
                {!! Form::label('last_name', trans('front.test.last_name'), ['class' => 'control-label']) !!}
            </div>
            <div class="col-md-5 form-group">
                {!! Form::text('last_name', old('last_name'), ['class' => 'form-control', 'required' => '']) !!}
                @if ($errors->has('last_name'))
                    <p class="help-block alert-danger">
                        {{ $errors->first('last_name') }}
                    </p>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-md-3 form-group">
                {!! Form::label('gender', trans('front.test.gender'), ['class' => 'control-label']) !!}
            </div>
            <div class="col-md-5 form-group">
                <label class="kt-radio kt-radio--bold" style="width: 100%">
                    {!! Form::radio('gender', 'F', (old('gender') == "F" ? true : false), ['class' => 'control-label']) !!}
                    @lang('front.test.female')
                    <span></span>
                </label>
                <label class="kt-radio kt-radio--bold" style="width: 100%">
                    {!! Form::radio('gender', 'M', (old('gender') == "M" ? true : false), ['class' => 'control-label']) !!}
                    @lang('front.test.male')
                    <span></span>
                </label>
                <br>                
                <label class="kt-radio kt-radio--bold" style="width: 100%">
                    {!! Form::radio('gender', 'T', (old('gender') == "T" ? true : false), ['class' => 'control-label']) !!}
                    @lang('front.test.transgender')
                    <span></span>
                </label>
                <label class="kt-radio kt-radio--bold" style="width: 100%">
                    {!! Form::radio('gender', 'N', (old('gender') == "N" ? true : false), ['class' => 'control-label']) !!}
                    @lang('front.test.non_binary-conforming')
                    <span></span>
                </label>
                <label class="kt-radio kt-radio--bold" style="width: 100%">
                    {!! Form::radio('gender', 'P', (old('gender') == "P" ? true : false), ['class' => 'control-label']) !!}
                    @lang('front.test.prefer_not_to_respond')
                    <span></span>
                </label>
                @if ($errors->has('gender'))
                    <p class="help-block alert-danger">
                        {{ $errors->first('gender') }}
                    </p>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-md-3 form-group">
                {!! Form::label('adult', trans('front.test.adult'), ['class' => 'control-label']) !!}
            </div>
            <div class="col-md-5 form-group">
                <label class="kt-radio kt-radio--bold">
                    {!! Form::radio('adult', 'Y', (old('adult') == "Y" ? true : false), ['class' => 'control-label']) !!}
                    @lang('front.test.over_18')
                    <span></span>
                </label>
                <br>
                <label class="kt-radio kt-radio--bold">
                    {!! Form::radio('adult', 'N', (old('adult') == "N" ? true : false), ['class' => 'control-label']) !!}
                    @lang('front.test.under_18')
                    <span></span>
                </label>
                @if ($errors->has('adult'))
                    <p class="help-block alert-danger">
                        {{ $errors->first('adult') }}
                    </p>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-md-3 form-group">
                {!! Form::label('email', trans('front.test.email'), ['class' => 'control-label']) !!}
            </div>
            <div class="col-md-5 form-group">
                {!! Form::email('email', old('email'), ['class' => 'form-control', 'required' => '']) !!}
                @if ($errors->has('email'))
                    <p class="help-block alert-danger">
                        {{ $errors->first('email') }}
                    </p>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-md-3 form-group">
                {!! Form::label('phone', trans('front.test.phone'), ['class' => 'control-label']) !!}
            </div>
            <div class="col-md-5 form-group">
                {!! Form::text('phone', old('phone'), ['class' => 'form-control']) !!}
                @if ($errors->has('phone'))
                    <p class="help-block alert-danger">
                        {{ $errors->first('phone') }}
                    </p>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-md-3 form-group">
                {!! Form::label('best_reached', trans('front.test.best_reached'), ['class' => 'control-label']) !!}
            </div>
            <div class="col-md-5 form-group">
                {!! Form::text('best_reached', old('best_reached'), ['class' => 'form-control']) !!}
                @if ($errors->has('best_reached'))
                    <p class="help-block alert-danger">
                        {{ $errors->first('best_reached') }}
                    </p>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-md-3 form-group">
                {!! Form::label('remark', trans('front.test.remark'), ['class' => 'control-label']) !!}
            </div>
            <div class="col-md-5 form-group">
                {!! Form::textarea('remark', old('remark'), ['rows' => 5, 'cols' => 64, 'class' => 'form-control']) !!}
                @if ($errors->has('remark'))
                    <p class="help-block alert-danger">
                        {{ $errors->first('remark') }}
                    </p>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-md-3 form-group">
                {!! Form::label('gdpr', trans('front.test.gdpr'), ['class' => 'control-label']) !!}
            </div>
            <div class="col-md-7 form-group">
                <label class="kt-checkbox kt-checkbox--bold kt-checkbox--brand">
                    {!! Form::checkbox('gdpr', 1, (old('gdpr') == 1 ? true : false), ['class' => 'control-label', 'required' => '']) !!}
                    @lang('front.test.gdpr_accept', ['privacy-policy-link' => route('privacy-policy'), 'terms-of-service-link' => route('terms-of-service')])
                    <span></span>
                </label>
                @if ($errors->has('gdpr'))
                    <p class="help-block alert-danger">
                        {{ $errors->first('gdpr') }}
                    </p>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-11 form-group" style="font-family: Tahoma, Geneva, sans-serif;">
                @lang('front.test.privacy_notice')
            </div>
        </div>

        <div class="row">
            <div class="col-md-10 form-group" style="text-align: center;">
                {!! Form::submit(trans('front.test.submit_proceed'), ['class' => 'btn btn-primary']) !!}
            </div>
        </div>

        {!! Form::close() !!}
    </div>

    <div class="col-xl-4"></div>
@stop