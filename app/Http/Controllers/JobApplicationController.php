<?php

namespace App\Http\Controllers;

use App\JobApplication;
use Illuminate\Http\Request;

class JobApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('generic-job-application');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, \App\JobAdvert $jobAdvert, \App\User $user)
    {
        return view('job-application-form', compact('jobAdvert', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, \App\JobAdvert $jobAdvert, \App\User $user)
    {
        $request->validate([
            "lastname"      => "required|string|max:100",
            "firstname"     => "required|string|max:100",
            "address"       => "required|string|max:300",
            "phone_number"  => "required|string|max:50",
            "sell_yourself" => "required|string|max:300",
            "cv"            => "required|mimes:pdf",
        ]);

        $user->update($request->only(['lastname', 'firstname', 'address', 'phone_number', 'sell_yourself']));

        $jobApplication = \App\JobApplication::create([
            'user_id'         => $user->id,
            'job_position_id' => $jobAdvert->jobPosition->id,
        ]);

        $jobApplication->addMedia($request->file('cv'))->toMediaCollection('cv');

        return view("job-application-form", array_merge(compact('jobAdvert', 'user'), ['formFilled' => true]));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\JobApplication  $jobApplication
     * @return \Illuminate\Http\Response
     */
    public function show(JobApplication $jobApplication)
    {
        //get status of your job application
        return view('applicant-dashboard', compact(extract($jobApplication->toArray())));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\JobApplication  $jobApplication
     * @return \Illuminate\Http\Response
     */
    public function edit(JobApplication $jobApplication)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\JobApplication  $jobApplication
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JobApplication $jobApplication)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\JobApplication  $jobApplication
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobApplication $jobApplication)
    {
        //
    }
}
