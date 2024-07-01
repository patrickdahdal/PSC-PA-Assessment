<?php
// FRONTEND routes
// Public pages
// Route::get('cache/clear',function(){
//     Artisan::call('config:cache');
// });
Route::get('/', 'FrontController@index')->name('home');
Route::get('privacy-policy', 'FrontController@showPage')->name('privacy-policy');
Route::get('terms-of-service', 'FrontController@showPage')->name('terms-of-service');

// Test/Assessment
Route::get('membercode', 'FrontController@enterMembercode')->name('membercode');
Route::post('membercode/save', ['uses' => 'FrontController@verifyMembercode', 'as' => 'membercode.save']);
Route::get('register', 'FrontController@createRespondent')->name('register');
Route::post('register/save', ['uses' => 'FrontController@storeRespondent', 'as' => 'register.save']);
Route::get('instructions', 'FrontController@showInstructions')->name('instructions');
Route::get('test', 'FrontController@assessmentWizard')->name('test');
Route::post('test', 'FrontController@assessmentWizard')->name('test');
Route::get('test/verify', ['uses' => 'FrontController@verifyAssessment', 'as' => 'test.verify']);
Route::post('test/verify/submit', ['uses' => 'FrontController@verifyAssessmentSubmit', 'as' => 'test.verify.submit']);
Route::post('test/save', ['uses' => 'FrontController@assessmentWizardFinish', 'as' => 'test.save']);
Route::get('thank-you', 'FrontController@showPage')->name('thank-you');

// CUSTOMER routes
Route::get('auth', 'CustomerController@customerAuth')->name('account.auth');
Route::post('auth/login', 'CustomerController@customerAuthLogin')->name('account.auth.login');
Route::get('auth/logout', 'CustomerController@customerAuthLogout')->name('account.auth.logout');
Route::get('profile', 'CustomerController@profileView')->name('account.profile');
Route::redirect('account', 'account/index');
Route::get('account/index', 'CustomerController@resultsIndex')->name('account.index');
Route::get('account/answers/{id}', 'CustomerController@resultsAnswers')->name('account.answers');
Route::get('account/score/{id}', 'CustomerController@resultsScore')->name('account.score');

Route::group(['prefix' => 'customers'], function() {        
    Route::get('password/reset', 'Customer\CustomerPasswordController@showLinkRequestForm')->name('customers.password.showLinkRequestForm');
    Route::post('password/email', 'Customer\CustomerPasswordController@sendResetPasswordMail')->name('customers.password.sendRestLinkEmail');
    Route::get('password/reset/{token}', 'Customer\CustomerPasswordController@showResetForm')->name('customers.password.showResetForm');
    Route::post('password/reset', 'Customer\CustomerPasswordController@reset')->name('customers.password.reset');
});

// ADMIN routes
// Authentication
Route::get('login', 'Auth\LoginController@showLoginForm')->name('auth.login');
Route::post('login', 'Auth\LoginController@login')->name('auth.login');
Route::post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Change password
Route::get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
Route::patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password reset
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');

// Admin management system
Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    // Dashboard
    Route::get('home', 'Admin\HomeController@index')->name('home');

    // Roles and Permissions routes
    Route::resource('permissions', 'Admin\PermissionsController');
    Route::post('permissions_mass_destroy', ['uses' => 'Admin\PermissionsController@massDestroy', 'as' => 'permissions.mass_destroy']);
    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);

    // Customers and Respondents routes
    Route::resources([
        'customers' => 'Admin\CustomersController',
        'respondents' => 'Admin\RespondentsController'
    ]);
    Route::post('customers_mass_destroy',['uses'=>'Admin\CustomersController@customersMassDestroy','as'=>'customers.mass_destroy']);

    // Assessments, Questions and Traits routes
    Route::get('assessments', 'Admin\AssessmentsController@index')->name('assessments.index');
    Route::get('assessments/answers/{id}', 'Admin\AssessmentsController@answers')->name('assessments.answers');
    Route::get('assessments/score/{id}', 'Admin\AssessmentsController@score')->name('assessments.score');
    Route::get('questions', 'Admin\QuestionsController@index')->name('questions.index');
    Route::get('questions/answers', 'Admin\QuestionsController@answersIndex')->name('questions.answers');
    Route::get('traits', 'Admin\TraitsController@index')->name('traits.index');
});
