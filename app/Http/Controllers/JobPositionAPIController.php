<?php

namespace App\Http\Controllers;

use App\JobPosition;
use App\Http\Resources\JobPositionCollection;
use App\Http\Resources\JobPositionResource;
 
class JobPositionAPIController extends Controller
{
    public function index()
    {
        return new JobPositionCollection(JobPosition::paginate());
    }
 
    public function show(JobPosition $jobPosition)
    {
        return new JobPositionResource($jobPosition->load(['jobAdverts', 'company']));
    }

    public function store(Request $request)
    {
        return new JobPositionResource(JobPosition::create($request->all()));
    }

    public function update(Request $request, JobPosition $jobPosition)
    {
        $jobPosition->update($request->all());

        return new JobPositionResource($jobPosition);
    }

    public function destroy(Request $request, JobPosition $jobPosition)
    {
        $jobPosition->delete();

        return response()->json([], \Illuminate\Http\Response::HTTP_NO_CONTENT);
    }
}
