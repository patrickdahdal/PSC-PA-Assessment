@extends('frontend.layouts.default')
@section('page_heading', trans('front.pages.instructions.title'))
@section('content')
    <div class="col-xl-10">
        <div class="row">
            <h4>Instructions</h4>
            <p>1. At the start of the test there are two preliminary questions that ask for your gender and whether you are at least 18 or not. These questions need to be answered in order for us to be able to give you your results. These are followed by 210 questions which are generally very easy to answer. A fast reader who has done the test before can probably get through in under 20 minutes, but other people may find that 40 or even 60 minutes are required.</p>
            <p>2. When answering the questions, click one of the five columns by the side of each question:</p>
            <div class="kt-list-timeline">
                <div class="kt-list-timeline__items">
                    <div class="kt-list-timeline__item">
                        <span class="kt-list-timeline__badge kt-list-timeline__badge--primary"></span>
                        <span class="kt-list-timeline__text">The first column is marked <mark class="lead kt-font-bold">"Y"</mark> and means definitely so, yes, or nearly always yes.</span>
                    </div>
                    <div class="kt-list-timeline__item">
                        <span class="kt-list-timeline__badge kt-list-timeline__badge--primary"></span>
                        <span class="kt-list-timeline__text">The second column is marked <mark class="lead kt-font-bold">"+"</mark> and means mostly yes, yes more than no.</span>
                    </div>
                    <div class="kt-list-timeline__item">
                        <span class="kt-list-timeline__badge kt-list-timeline__badge--primary"></span>
                        <span class="kt-list-timeline__text">The third column is marked <mark class="lead kt-font-bold">"M"</mark> and means maybe, don't know, unsure or sometimes yes and sometimes no.</span>
                    </div>
                    <div class="kt-list-timeline__item">
                        <span class="kt-list-timeline__badge kt-list-timeline__badge--primary"></span>
                        <span class="kt-list-timeline__text">The fourth column is marked <mark class="lead kt-font-bold">"-"</mark> and means mostly no, no more than yes.</span>
                    </div>
                    <div class="kt-list-timeline__item">
                        <span class="kt-list-timeline__badge kt-list-timeline__badge--primary"></span>
                        <span class="kt-list-timeline__text">The fifth column is marked <mark class="lead kt-font-bold">"N"</mark> and means definitely not, no or nearly always no.</span>
                    </div>
                    <div>
                        <span>Choose the option that most closely matches your answer.</span>
                    </div>
                </div>
            </div>
            <p><br>3. If your answer to a question now is different to how you might have answered the question in the past, answer it as you would now.</p>
            <p>4. You may feel that some questions do not apply to you. For example there is a question that concerns whether you plan to have a large family, which older people may consider does not apply to them. If you come across a question which you feel does not apply, answer it as if you were in a position where it did apply.</p>
            <p><br></p>
        </div>

        <div class="row">
            <p><a href="{{ url('/test') }}" class="btn btn-success btn-lg">
                    <i class="fa flaticon2-fast-next"></i> @lang('front.test.submit_start_test')</a></p>
            <p><br></p>
        </div>
    </div>

    <div class="col-xl-2">
        <div class="row">
            <p><br></p>
        </div>
    </div>
@stop
