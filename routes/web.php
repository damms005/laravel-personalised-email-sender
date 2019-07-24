<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::match(['get', 'post'], 'send-bulk-email', function (Illuminate\Http\Request $request) {
    foreach ($request->input() as $email => $message) {
        echo "\n\n <br><br>" . \App\Http\Controllers\EmailController::sendMail($email, \App\Company::all()->first(), $message, "SchoolServer Interview");
    }
});

Route::get('logout', function () {
    if (auth()->check()) {
        Auth::logout();
    }

    return response('Logged out!');
});

Route::get('/', function () {
    return redirect()->away('https://schoolserver.com.ng');
});

Route::get('/home', function () {redirect('/');})->name('home');

//normal users job application
Route::group(['prefix' => 'jobs'], function () {

    //TODO: a route that handles generic random job seeker traffic: just a login page, after which if well logged-in, will take you to your job statuses page
    //if not, makes you verify your email and then shows you a list of availble stuff
    Route::get('oops-page', "JobApplicationController@index")->name('generic-job-application-homepage');

    //initialize applicant
    Route::match(['get', 'post'], 'apply/{jobAdvert?}/{user?}', 'ApplicantController@create')->name('job-application-start-page');

    //confirmation route for job application
    Route::match(['get', 'post'], 'account/{user}/verify/{jobAdvert}', 'ApplicantController@store')->name('verify-account');

    //verified account
    Route::group(['middleware' => ['auth', 'verified']], function () {

        //show job application form
        Route::get('form/{jobAdvert}/{user}', 'JobApplicationController@create')->name('show-application-form');

        //submit application form
        Route::post('submit/{jobAdvert}/{user}', "JobApplicationController@store")->name('submit-job-application');

        //check job update
        Route::get('status/{user}/{jobApplication?}', "JobApplicationController@show")->name('job-application-status');

    });

});

//applicants: after you have applied
Route::group(['prefix' => 'applicant'], function () {
    Route::get('show/{applicant}', function ($id) {
    });
});

Route::group(['prefix' => 'admin'], function () {

    Voyager::routes();

    Route::group(['prefix' => 'manage/jobs', 'middleware' => 'auth'], function () {

        Route::get('build-email', "BuildEmailController@build")->name('build-email');

    });

});

Auth::routes(['verify' => true]);
