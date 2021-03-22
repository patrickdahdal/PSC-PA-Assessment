@extends('frontend.layouts.default')
@section('page_heading', trans('front.pages.home.title'))
@section('content')
    <div class="row">
        <div class="col-xl-10">
            <p>You're here because you were invited to take this assessment for self-development,
                job, career or business opportunities.</p>

            <p>The Personality Assessment will give you a deep and very precise understanding of how
                you operate in the world and uncover the hidden areas of improvement. It will also
                reveal your main block that is holding you back at this moment of time from achieving
                your full potential.</p>

            <p>Once you are aware of this main block and have the tools to release it you will experience
                a major surge in your life.</p>

            <p>You will unleash more of your potential that can be directed to dramatically improve
                e.g. your career, business, relationships, your personal development,
                leadership skills, communication to name a few.</p>

            <p>The Personality Assessment is an accurate and non-biased means by which life coaches, trainers,
                managers, consultants, practitioners and health coaches can see someone's areas of Strength,
                Weakness, Opportunities and Threats. With the snapshot if provides, these professionals can
                design programs that precisely and effectively address the issues that align with their own areas
                of expertise. Workshop leaders can design programs that are penetrating, highly transformative
                and well received.</p>

            <p>Only a trained person can take you through your assessment results with you. This person is
                called a Certified Personality Assessment Evaluator.</p>

            <p>Your Certified Personality Assessment Evaluator will go through this assessment with you
                after completion and also provide you options of how you can improve your results as
                described above.</p>

            <p>To access and complete this assessment you will need a <strong>membercode</strong> which you will have
                received from the person, business or organization that invited you to this page.</p>

            <p>This membercode is what you fill in as the first step to get access to the actual
                assessment area.</p>

            <p>To access the assessment area click on Straight into test on the menu to the left
                of this text.</p>

            <p>For best results please make sure you are in a undisturbed area and put aside
                40-60 minutes to complete the assessment.</p>

            <p><br></p>
            <p><a href="{{ route('membercode') }}" class="btn btn-outline-brand">
                    <i class="fa flaticon2-fast-next"></i> Click here to start the assessment</a></p>

            <p><br></p>
            <p>If you're interested in becoming a Certified Personality Assessment Evaluator <a href="https://www.personalityassessmentcertification.com" target="_blank">click here</a>.</p>
        </div>
    </div>
@stop