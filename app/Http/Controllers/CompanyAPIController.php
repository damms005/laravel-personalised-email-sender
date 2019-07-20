<?php

namespace App\Http\Controllers;

use App\Company;
use App\Http\Resources\CompanyCollection;
use App\Http\Resources\CompanyResource;
 
class CompanyAPIController extends Controller
{
    public function index()
    {
        return new CompanyCollection(Company::paginate());
    }
 
    public function show(Company $company)
    {
        return new CompanyResource($company->load(['jobPositions', 'emailTemplates']));
    }

    public function store(Request $request)
    {
        return new CompanyResource(Company::create($request->all()));
    }

    public function update(Request $request, Company $company)
    {
        $company->update($request->all());

        return new CompanyResource($company);
    }

    public function destroy(Request $request, Company $company)
    {
        $company->delete();

        return response()->json([], \Illuminate\Http\Response::HTTP_NO_CONTENT);
    }
}
