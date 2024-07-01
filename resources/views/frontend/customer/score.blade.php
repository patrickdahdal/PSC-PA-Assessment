@extends('frontend.layouts.default')
@section('page_heading', trans('global.assessments.score'))
@section('content')
    <div class="row">
        <div class="form-group">
            <a href="{{ route('account.index') }}" class="btn btn-primary">
                <i class="fa flaticon2-fast-back"></i> @lang('global.app.back_to_list')</a>
            <a href="{{ route('account.answers', ['id' => $assessment->id]) }}" class="btn btn-info">
                <i class="fa flaticon-list-3"></i> @lang('global.assessments.answers')</a>
            <a href="#" class="btn btn-outline-dark print-link">
                <i class="fa flaticon-interface-11"></i> @lang('global.app.print')</a>
        </div>
    </div>

    <div class="row" id="test-results">
        <div class="col-xl-10">
            <h4>{{ $assessment->respondent->first_name }} {{ $assessment->respondent->last_name }}</h4>

            <h5><small class="text-muted">@lang('global.respondents.fields.gender')</small> &nbsp; &nbsp; &nbsp;
                {{ $assessment->respondent->gender }}</h5>

            <h5><small class="text-muted">@lang('global.respondents.fields.adult')</small> &nbsp;
                {{ $assessment->respondent->adult }}</h5>

            <br><h4>@lang('global.assessments.test_results')</h4>
            {!! $html_content !!}
        </div>
    </div>

    <div class="row">
        <div class="form-group">
            <a href="{{ route('account.index') }}" class="btn btn-primary">
                <i class="fa flaticon2-fast-back"></i> @lang('global.app.back_to_list')</a>
            <a href="{{ route('account.answers', ['id' => $assessment->id]) }}" class="btn btn-info">
                <i class="fa flaticon-list-3"></i> @lang('global.assessments.answers')</a>
            <a href="#" class="btn btn-outline-dark print-link">
                <i class="fa flaticon-interface-11"></i> @lang('global.app.print')</a>
        </div>
    </div>
@stop

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $("a.print-link").click(function() {
                var originalContents = document.body.innerHTML;
                var printContents = document.getElementById('test-results').innerHTML;

                $("body").html(printContents);
                $("body").css({"padding-top":"0"});
                $("body").css({"display":"block"});
                $("body").css({"position":"static"});

                window.print();

                return false;
            });
        });
    </script>
@stop
