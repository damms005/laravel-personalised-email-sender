<?php

namespace App\Http\Controllers;

use App\EmailTemplate;
use App\Http\Resources\EmailTemplateCollection;
use App\Http\Resources\EmailTemplateResource;
 
class EmailTemplateAPIController extends Controller
{
    public function index()
    {
        return new EmailTemplateCollection(EmailTemplate::paginate());
    }
 
    public function show(EmailTemplate $emailTemplate)
    {
        return new EmailTemplateResource($emailTemplate->load(['company']));
    }

    public function store(Request $request)
    {
        return new EmailTemplateResource(EmailTemplate::create($request->all()));
    }

    public function update(Request $request, EmailTemplate $emailTemplate)
    {
        $emailTemplate->update($request->all());

        return new EmailTemplateResource($emailTemplate);
    }

    public function destroy(Request $request, EmailTemplate $emailTemplate)
    {
        $emailTemplate->delete();

        return response()->json([], \Illuminate\Http\Response::HTTP_NO_CONTENT);
    }
}
