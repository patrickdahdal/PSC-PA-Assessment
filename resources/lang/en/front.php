<?php

return [
    'pages' => [
        // Public pages
        'home' => [
            'title' => 'Welcome To The Personality Assessment',
            'menu'  => 'Homepage',
            'link'  => 'Back to Homepage'
        ],
        'example' => [
            'title' => 'Example Test Results',
            'menu'  => 'Example results'
        ],
        'privacy-policy' => [
            'title' => 'GDPR and Privacy Policy',
            'link'  => 'GDPR Privacy Policy'
        ],
        'terms-of-service' => [
            'title' => 'Terms of Service and Cookie Policy',
            'link'  => 'Terms of Service'
        ],

        // Test/Assessment pages
        'membercode' => [
            'title' => 'Enter Your Membercode'
        ],
        'register' => [
            'title' => 'One-step Registration'
        ],
        'instructions' => [
            'title' => 'Test Instructions'
        ],
        'test' => [
            'title' => 'Personality Assessment Test',
            'menu'  => 'Straight into the test',
            'link'  => 'The Personality Assessment Test'
        ],
        'verify' => [
            'title' => 'Verify Assessment Test status',
            'descr' => 'Please enter your Membercode and Email address to check the status of your assessment.',
        ],
        'thank-you' => [
            'title' => 'Assessment Test completed',
            'descr' => 'Congratulations! Your Assessment Test is complete!'
        ],

        // Customer pages
        'auth' => [
            'title' => 'Customer Area',
            'menu'  => 'Login',
            'link'  => 'Login'
        ],
        'account' => [
            'title' => 'My Account',
            'menu'  => 'My Account',
            'link'  => 'My Account'
        ],
        'profile' => [
            'title' => 'My Profile',
            'menu'  => 'My Profile',
            'link'  => 'My Profile',
            'descr' => 'Account details and contact information',
        ],
        'results' => [
            'title' => 'Results & Score',
            'menu'  => 'Results & Score',
            'link'  => 'Results & Score',
            'descr' => 'Respondents tests evaluation and answers',
        ],
    ],

    'test' => [
        'submit_next' => 'Next &#9658;',
        'submit_proceed' => 'Proceed &#9658;',
        'submit_start_test' => 'Start Test',
        'submit_done' => 'Done',
        'membercode_placeholder' => 'Enter Membercode',
        'membercode_invalid' => 'Please enter a valid membercode',
        'membercode' => 'Membercode',
        'first_name' => 'First name',
        'last_name' => 'Last name',
        'gender' => 'Gender',
        'male' => 'Man',
        'female' => 'Woman',
        'transgender' => 'Transgender',
        'non_binary-conforming' => 'Non-binary/non-confirming',
        'prefer_not_to_respond' => 'Prefer not to respond',        
        'adult' => 'Age',
        'over_18' => '18 years and over',
        'under_18' => 'under 18 years',
        'email' => 'Email',
        'email_not_found' => 'No Assessment Test found for this email address',
        'phone' => 'Telephone',
        'best_reached' => 'I am best reached',
        'remark' => 'Remark (optional)',
        'gdpr' => 'Privacy Policy GDPR',
        'gdpr_accept' => 'I accept <a href=":privacy-policy-link" target="_blank">'
            .'The Personality Assessment Privacy Policy, GDPR</a> and '
            .'<a href=":terms-of-service-link" target="_blank">Terms of Service</a>',
        'privacy_notice' => '<p>All data related to this test form are used under strict compliance of privacy protection laws and are never shared with or sold to any third party.'
            .'<br>We only use your data for the sole purpose to administer the assessment/test and to provide you with an evaluation of that assessment/test.</p>',
        'back_to_test' => 'Back to beginning of test',
        'questions_validation' => 'Please complete the form by answering missed questions: ',
        'total_unanswered' => 'total :count unanswered.',
        'unknown_error' => 'Entry validation error. Please try again.',
        'thank_you' => 'An evaluator will contact you to go through the test results with you.'
    ],

    'auth' => [
        'login' => 'Sign In',
        'logout' => 'Sign Out',
        'email' => 'Email',
        'password' => 'Password',
        'remember' => 'Remember Me',
        'failed' => 'These credentials do not match any account. Please check and try again.',
    ],

];