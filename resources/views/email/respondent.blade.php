@component('mail::message')
<h3 style="margin-bottom: 20px;">
    <b style="font-weight: bold;">Subject:</b>
    Congratulations on Completing Your Personality Assessment!
</h3>
<p style="margin-bottom: 20px;">Dear {{ $respondent->first_name . ' ' . $respondent->last_name }},</p>
<p style="margin-bottom: 20px;">Congratulations on completing your Personality Assessment!</p>
<p style="margin-bottom: 20px;">
    We are excited to provide you with valuable insights and understandings about yourself.
    Please take a few minutes to read this email thoroughly as it provides you with valuable
    insights and next steps on your journey.
</p>
<p style="margin-bottom: 20px;">
    Here are some of the key insights you'll gain from this assessment:
</p>
<ul style="margin-bottom: 20px; padding-left: 20px;">
    <li style="margin-bottom: 10px;">
        <b>Personal Clarity:</b>
        Gain a more profound understanding of your own personality, including both
        conscious and unconscious traits. Discover how your intrinsic characteristics
        influence your daily behavior and decision-making processes.
    </li>
    <li style="margin-bottom: 10px;">
        <b>Elimination of Barriers:</b>
        Identify and understand the primary hidden blocks that are preventing
        you from achieving your goals. By understanding your primary block, you’ll
        also have the pathway to eliminating any persisting problems you have in life.
    </li>
    <li style="margin-bottom: 10px;">
        <b>Behavioral Awareness:</b>
        Recognize the specific habits and patterns that may be holding you back.
        Understand your behavioral tendencies, and how they affect your interactions
        and outcomes.
    </li>
    <li style="margin-bottom: 10px;">
        <b>Enhanced Self-Awareness:</b>
        Identify hidden aspects of your personality that you may not have been aware of before.
        Gain awareness of both your strengths and areas that need improvement, fostering a
        balanced self-view.
    </li>
    <li style="margin-bottom: 10px;">
        <b>Motivational Drivers:</b>
        Learn what truly motivates you and drives your actions.
        Understand what factors enhance or impede your motivation,
        helping you to stay focused and driven.
    </li>
    <li style="margin-bottom: 10px;">
        <b>Tailored Personal Development Roadmap:</b>
        Receive a personalized development plan that leverages your strengths while addressing
        areas for improvement and releases your hidden blocks. This roadmap will include specific
        techniques and practices to help you achieve your personal growth goals.
    </li>
    <li style="margin-bottom: 10px;">
        <b>Get the Opportunity To Get Quality Feedback and Support:</b>
        Have the opportunity to go deeper on your personal development journey with either
        the Personality Assessment AI or a Certified Personality Science Coach.
    </li>
</ul>
<p style="margin-bottom: 20px;">(Note: These insights will be delivered to you either by our Personality Assessment AI
    or a Certified Personality Assessment Evaluator.)
</p>
<p style="font-weight: bold; margin-bottom: 10px;">
    Important to Know Before You Read Further:
</p>
<ul style="margin-bottom: 20px; padding-left: 20px;">
    <li style="margin-bottom: 10px;">Do not evaluate this test on your own as you don't have the full set of information
        or training to understand what the different traits and corresponding numbers mean.</li>
    <li style="margin-bottom: 10px;">What seems low or high is not equal to good or bad. Very important to understand as
        you’ll see when you get your full report. You might be surprised.</li>
    <li style="margin-bottom: 10px;">The assessment must be evaluated either by a certified Personality Assessment AI or
        a Certified Personality Assessment Evaluator for you to get a full understanding of your results.</li>
</ul>
<p style="margin-bottom: 20px;">
    Here are your Personality Assessment Results:
</p>
<p style="margin-bottom: 20px;">
    {!! $results !!}
</p>
<p style="margin-bottom: 20px;">
    <b>Next Steps:</b>
</p>
<p style="margin-bottom: 20px;">To get access to your tailored Personality Assessment Report, please watch this short
    video:
    <a href="https://www.personalityassessment.ai/resultsvideo">
        https://www.personalityassessment.ai/resultsvideo
    </a>
</p>
<p style="margin-bottom: 20px;">Thank you for taking this important step in your personal development journey. If you
    have any questions or need further assistance, please do not hesitate to contact us.</p>
<p style="margin-bottom: 20px;">Best regards,</p>
<p>
    Patrick Dahdal<br>
    Founder and CEO<br>
    The Personality Science Company
</p>
<p style="font-size: smaller; font-style: italic;">
Disclaimer<br><br>

The information provided in this Personality Assessment report is intended for informational purposes only and should not be construed as professional advice. The insights and recommendations are based on the responses provided by the individual and the methodology of the assessment tool.<br><br>

The Personality Assessment, its creators, employees, and affiliates do not guarantee the accuracy, completeness, or usefulness of the information contained in this report. The use of this report and the information therein is at the sole discretion and risk of the recipient.<br><br>

Limitations of Use<br><br>

This assessment is not a substitute for professional advice or therapy. The results should not be used as the sole basis for making any significant decisions regarding employment, personal relationships, health, or well-being. Individuals are encouraged to seek the advice of qualified professionals before making any decisions based on the assessment results.<br><br>

Liability<br><br>

The Personality Assessment, its creators, employees, and affiliates expressly disclaim any and all liability for any direct, indirect, incidental, special, consequential, or other damages arising out of or in any way related to the use of this Personality Assessment report. By using this report, the recipient agrees to indemnify and hold harmless The Personality Assessment, its creators, employees, and affiliates from any and all claims or liabilities.<br><br>

Privacy<br><br>

The Personality Assessment is committed to protecting the privacy and confidentiality of all individuals. Personal data collected during the assessment process will be handled in accordance with our privacy policy, which complies with relevant data protection regulations.<br><br>

Acceptance<br><br>

By using this report, the recipient acknowledges and accepts the terms of this disclaimer. If you do not agree with these terms, please do not use this report.
</p>
@endcomponent
