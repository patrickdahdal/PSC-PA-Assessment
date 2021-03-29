<?php

return [
    'site' => [
        'url' => 'https://www.personalityassessment.me',
        'url_short' => 'www.personalityassessment.me',
        'title' => 'Personality Assessment',
        'author' => 'PersonalityAssessment.me',
        'copyright' => 'Copyright &copy; 2018-2021 PersonalityAssessment.me',
    ],

    'app' => [
        'dashboard' => 'Dashboard',
        'list' => 'List',
        'list_entries' => 'List - :count entries',
        'view' => 'View',
        'add_new' => 'Add new',
        'create' => 'Create',
        'save' => 'Save',
        'edit' => 'Edit',
        'update' => 'Update',
        'delete' => 'Delete',
        'are_you_sure' => 'Are you sure?',
        'back_to_list' => 'Back to list',
        'cancel' => 'Cancel',
        'no_entries_in_table' => 'No entries in table',
        'action_forbidden' => 'Action not permitted',
        'logout' => 'Sign Out',
        'not_available' => 'n/a',
        'created_at' => 'Created at',
        'print' => 'Print',
    ],

    'user-management' => [
        'title' => 'User Management',
        'created_at' => 'Time',
        'fields' => [
        ],
    ],

    'permissions' => [
        'title' => 'Permissions',
        'created_at' => 'Time',
        'fields' => [
            'name' => 'Name',
        ],
    ],

    'roles' => [
        'title' => 'Roles',
        'created_at' => 'Time',
        'fields' => [
            'name' => 'Name',
            'permission' => 'Permissions',
        ],
    ],

    'users' => [
        'title' => 'Users',
        'created_at' => 'Time',
        'fields' => [
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'roles' => 'Roles',
            'remember-token' => 'Remember token',
        ],
    ],

    'customers' => [
        'title' => 'Customers',
        'fields' => [
            'company_name' => 'Company name',
            'first_name' => 'First name',
            'last_name' => 'Last name',
            'full_name' => 'Name',
            'title' => 'Title',
            'email' => 'Email',
            'phone' => 'Phone',
            'membercode' => 'Membercode',
            'password' => 'Password',
            'password_confirmation' => 'Confirm password',
            'active' => 'Is active',
            'created_at' => 'Active since',
        ],
    ],

    'respondents' => [
        'title' => 'Respondents',
        'fields' => [
            'full_name' => 'Full name',
            'first_name' => 'First name',
            'last_name' => 'Last name',
            'gender' => 'Gender',
            'adult' => 'Adult (18+)',
            'email' => 'Email',
            'phone' => 'Phone',
            'best_reached' => 'Best reached',
            'remark' => 'Remark',
            'membercode' => 'Membercode',
        ],
    ],

    'assessments' => [
        'title' => 'Assessments',
        'fields' => [
            'respondent' => 'Respondent',
            'question' => 'Question',
            'answer' => 'Answer',
        ],
        'score' => 'Score',
        'answers' => 'Answers',
        'test_results' => 'Test Results',
        'test_answers' => 'Test Answers',
    ],

    'questions' => [
        'title' => 'Questions',
        'fields' => [
            'question' => 'Question',
            'number' => 'Number',
            'group' => 'Group',
        ],
    ],

    'answers' => [
        'title' => 'Answers',
        'fields' => [
            'answer' => 'Answer',
            'number' => 'Number',
        ],
    ],

    'traits' => [
        'title' => 'Traits',
        'fields' => [
            'key' => 'Key',
            'trait' => 'Trait',
            'number' => 'Number',
        ],
    ],
];