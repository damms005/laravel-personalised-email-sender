<?php

namespace App\Http\Controllers;

use App\JobAdvert;
use App\Http\Resources\JobAdvertCollection;
use App\Http\Resources\JobAdvertResource;
 
class JobAdvertAPIController extends Controller
{
    public function index()
    {
        return new JobAdvertCollection(JobAdvert::paginate());
    }
 
    public function show(JobAdvert $jobAdvert)
    {
        return new JobAdvertResource($jobAdvert->load(['jobPosition']));
    }

    public function store(Request $request)
    {
        return new JobAdvertResource(JobAdvert::create($request->all()));
    }

    public function update(Request $request, JobAdvert $jobAdvert)
    {
        $jobAdvert->update($request->all());

        return new JobAdvertResource($jobAdvert);
    }

    public function destroy(Request $request, JobAdvert $jobAdvert)
    {
        $jobAdvert->delete();

        return response()->json([], \Illuminate\Http\Response::HTTP_NO_CONTENT);
    }
}
