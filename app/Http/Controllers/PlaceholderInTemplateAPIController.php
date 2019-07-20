<?php

namespace App\Http\Controllers;

use App\PlaceholderInTemplate;
use App\Http\Resources\PlaceholderInTemplateCollection;
use App\Http\Resources\PlaceholderInTemplateResource;
 
class PlaceholderInTemplateAPIController extends Controller
{
    public function index()
    {
        return new PlaceholderInTemplateCollection(PlaceholderInTemplate::paginate());
    }
 
    public function show(PlaceholderInTemplate $placeholderInTemplate)
    {
        return new PlaceholderInTemplateResource($placeholderInTemplate->load([]));
    }

    public function store(Request $request)
    {
        return new PlaceholderInTemplateResource(PlaceholderInTemplate::create($request->all()));
    }

    public function update(Request $request, PlaceholderInTemplate $placeholderInTemplate)
    {
        $placeholderInTemplate->update($request->all());

        return new PlaceholderInTemplateResource($placeholderInTemplate);
    }

    public function destroy(Request $request, PlaceholderInTemplate $placeholderInTemplate)
    {
        $placeholderInTemplate->delete();

        return response()->json([], \Illuminate\Http\Response::HTTP_NO_CONTENT);
    }
}
