@component('mail::message')
<h3 style="margin-bottom: 20px;">
    <b style="font-weight: bold;">Subject:</b> 
    New Respondent Notification and Next Steps
</h3>

<p style="margin-bottom: 20px;">Dear {{ $customer->first_name.' '.$customer->last_name }},</p>
<p style="margin-bottom: 20px;">Congratulations! You have a new respondent who has completed the Personality Assessment. We are thrilled to see your engagement and commitment to leveraging our tools for personal development and coaching.</p>
<p style="margin-bottom: 20px;">We are especially excited that another person has taken the first step to change their life thanks to your work.</p>
<p style="margin-bottom: 20px;">Together, we are making a meaningful impact on another human being.</p>
<p style="margin-bottom: 20px;">Here is {{ $respondent->first_name.' '.$respondent->last_name }} Personality Assessment Results:</p>
<p style="margin-bottom: 20px;">
    {!! $results !!}
</p>

<p style="font-weight: bold; margin-bottom: 10px;">
    <strong>Next Steps for You:</strong>
</p>
<ol style="margin-bottom: 20px; padding-left: 20px;">
    <li style="margin-bottom: 10px;">Create the Evaluation Report: To create the Personality Assessment report for your new respondent, please visit <a href="http://nlpmentor.ai">nlpmentor.ai</a>.</li>
    <li style="margin-bottom: 10px;">Navigate to the Tab: Once on the site, go to the "Personality Assessment AI" tab.</li>
    <li style="margin-bottom: 10px;">Retrieve the Report: Follow the instructions and training you received when you became a member to create and review the detailed report on your respondent.</li>
</ol>
<p style="margin-bottom: 20px;">This report will provide you with comprehensive insights into their strengths, areas for improvement, hidden blocks, and a tailored development plan. It is designed to help you better understand and support your client's journey towards achieving their goals.</p>
<p style="margin-bottom: 20px;">Should you have any questions or need further assistance, please do not hesitate to contact us. We are here to support you every step of the way.</p>
<p style="margin-bottom: 20px;">Thank you for your continued hard work in making a difference.</p>

<p style="margin-bottom: 20px;">Best regards,</p>
<p>
    The Personality Assessment Team
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
