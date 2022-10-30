<?php

namespace Laravolt\Workflow\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Laravolt\Camunda\Http\ProcessDefinitionClient;
use Laravolt\Workflow\Models\ProcessDefinition;

class DefinitionController extends Controller
{
    public function index(): View
    {
        return view('laravolt::workflow.definition.index');
    }

    public function create(): View
    {
        $definitions = ProcessDefinitionClient::get(['latestVersion' => true]);
        $importedDefinitions = ProcessDefinition::pluck('id')->toArray();
        $definitions = collect($definitions)->reject(fn ($item) => in_array($item->id, $importedDefinitions));

        return view('laravolt::workflow.definition.create', compact('definitions'));
    }

    public function store(Request $request): RedirectResponse
    {
        ProcessDefinition::importFromCamunda(ProcessDefinitionClient::get($request->only('key')));

        return redirect()->route('workflow::definitions.index')->with('success', 'BPMN added');
    }

    public function show(string $key): View
    {
        $definition = ProcessDefinition::where('key', $key)->firstOrFail();

        return view('laravolt::workflow.definition.show', compact('definition'));
    }

    public function destroy(string $id): RedirectResponse
    {
        $model = ProcessDefinition::findOrFail($id);
        $model->delete();

        return redirect()->back()->with('success', __('BPMN definition removed'));
    }
}
