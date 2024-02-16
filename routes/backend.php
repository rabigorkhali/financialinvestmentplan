<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect(route('login.form'));
});

Route::get(getSystemPrefix(), function () {
    return redirect(route('login.form'));
});

Route::group(['namespace' => 'System', 'prefix' => getSystemPrefix(), 'middleware' => ['language']], function () {
    Route::get('/login', 'Auth\LoginController@showLoginForm')->name('login.form');
    Route::post('/login', 'Auth\LoginController@login')->name('login');
    Route::get('forgot-password', 'Auth\ForgotPasswordController@showRequestForm')->name('forgot.password');
    Route::post('forgot-password', 'Auth\ForgotPasswordController@handleForgotPassword')->name('post.forgot.password');
    Route::get('/reset-password/{email}/{token}', 'Auth\ResetPasswordController@showSetResetForm')->name('reset.password');
    Route::post('/reset-password', 'Auth\ResetPasswordController@handleSetResetPassword');
    Route::get('/set-password/{email}/{token}', 'Auth\ResetPasswordController@showSetResetForm')->name('set.password');
    Route::post('/set-password', 'Auth\ResetPasswordController@handleSetResetPassword');
    Route::get('/', 'Auth\LoginController@showLoginForm');
    Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

    Route::group(['middleware' => ['auth', 'antitwofa']], function () {
        Route::get('/login/verify', 'Auth\VerificationController@showVerifyPage');
        Route::post('/login/verify', 'Auth\VerificationController@verify')->name('verify.post');
        Route::get('/login/send-again', 'Auth\VerificationController@sendAgain')->name('verify.send.again');
    });

    Route::group(['middleware' => ['auth']], function () {
        Route::get('change-password', 'user\UserController@changePassword')->name('change.password');
    });

    Route::group(['middleware' => ['auth', 'permission', 'twofa', 'reset.password']], function () {
        Route::get('/home', 'indexController@index')->name('home');
        Route::resource('/roles', 'user\RoleController', ['except' => ['show']]);

        Route::resource('/users', 'user\UserController', ['except' => ['show']]);

        Route::get('/profile', 'profile\ProfileController@index')->name('profile');
        Route::put('/profile/{id}', 'profile\ProfileController@update');

        Route::get('/profile-change-password', 'profile\PasswordChangeController@index')->name('profile.change-password-form');
        Route::put('/profile-change-password/{id}', 'profile\PasswordChangeController@update')->name('profile.change-password');


        Route::post('users/reset-password/{id}', 'user\UserController@passwordReset')->name('user.reset-password');

        Route::get('/login-logs', 'logs\LoginLogsController@index');
        Route::get('/activity-logs', 'logs\LogsController@index');

        Route::resource('/languages', 'language\LanguageController', ['except' => ['show', 'edit', 'update']]);
        Route::get('/languages/set-language/{lang}', 'language\LanguageController@setLanguage')->name('set.lang');
        Route::get('/country-language/{country_id}', 'countryLanguage\countryLanguageController@getLanguages');

        Route::resource('/translations', 'language\TranslationController', ['except' => ['show', 'edit', 'create']]);
        Route::get('/translations/download-sample', 'language\TranslationController@downloadSample');
        Route::get('/translations/download', 'language\TranslationController@downloadExcel');
        Route::post('/translations/upload', 'language\TranslationController@uploadExcel');


        Route::get('/clear-lang', function () {
            \App\Model\Locale::truncate();
        });
        Route::resource('/email-templates', 'systemConfig\emailTemplateController', ['except' => ['show', 'create', 'store']]);

        Route::resource('/configs', 'systemConfig\configController');

        Route::resource('/pages', 'page\PageController', ['except' => ['show']]);
        Route::get('pages/{id}/toggle-status', 'page\PageController@changePageStatus')->name('changeStatus');

        Route::resource('/api-logs', 'logs\ApiLogController', ['only' => ['index']]);
        Route::resource('/error-logs', 'logs\ErrorLogController', ['only' => ['index']]);

        Route::get('/login-logs/download-excel', 'logs\LoginLogsController@downloadExcel');
        Route::get('/api-logs/download-excel', 'logs\ApiLogController@downloadExcel');
        Route::get('/error-logs/download-excel', 'logs\ErrorLogController@downloadExcel');
        Route::get('/activity-logs/download-excel', 'logs\LogsController@downloadExcel');

        Route::get('/mail-test/create', 'MailTestController@create');
        Route::post('/mail-test', 'MailTestController@sendEmail');
    });
});
