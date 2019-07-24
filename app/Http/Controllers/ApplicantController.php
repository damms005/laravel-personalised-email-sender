<?php

namespace App\Http\Controllers;

use App\Applicant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class ApplicantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, \App\JobAdvert $jobAdvert)
    {
        if ($request->has('email')) {

            $request->validate([
                'email' => 'required|max:250|email',
            ]);

            if (env('APP_ENV') == 'production') {

                $request->validate([
                    'g-recaptcha-response' => 'required|captcha',
                ]);
            }

            $user = \App\User::where('email', $request->email)->first();

            //check for fresh application: job application but no user yet
            if (is_null($user) || !$user->exists) {

                $user        = new \App\User;
                $user->email = $request->email;
                $user->save();

                return $this->sendVerificationEmail($user, $jobAdvert);

            } else {

                if ($user->hasVerifiedEmail()) {
                    return redirect()->route('show-application-form', compact('jobAdvert', 'user'));
                } else {
                    return $this->sendVerificationEmail($user, $jobAdvert);
                }
            }
        } else {
            return view('init-job-applicant', compact('jobAdvert'));
        }
    }

    public function sendVerificationEmail(\App\User $user, \App\JobAdvert $jobAdvert)
    {
        $url                         = URL::signedRoute('verify-account', compact('jobAdvert', 'user'));
        $showVerificationSentMessage = true;
        EmailController::sendMail($user, $jobAdvert->jobPosition->company, "Email Confirmation for Job Application", "Link to activate your email: $url");
        return view('init-job-applicant', compact('showVerificationSentMessage', 'jobAdvert', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, \App\User $user, \App\JobAdvert $jobAdvert)
    {
        $user->markEmailAsVerified();
        Auth::login($user, true);
        return response()->redirectToRoute('show-application-form', compact('jobAdvert', 'user'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Applicant  $applicant
     * @return \Illuminate\Http\Response
     */
    public function show(Applicant $applicant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Applicant  $applicant
     * @return \Illuminate\Http\Response
     */
    public function edit(Applicant $applicant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Applicant  $applicant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Applicant $applicant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Applicant  $applicant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Applicant $applicant)
    {
        //
    }
}
