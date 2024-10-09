<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use Illuminate\Support\Facades\Storage;
use App\Models\Category;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.projects.create', compact('categories'));
    }

    public function store(StoreProjectRequest $request)
    {
        $form_data = $request->all();
        $form_data['slug'] = Project::generateSlug($form_data['name'], '-');

        if ($request->hasFile('project_image')) {
            $path = Storage::disk('public')->put('project_image', $form_data['project_image']);
            $form_data['project_image'] = $path;
        }

        $project = new Project();
        $project->fill($form_data);
        $project->save();

        return redirect()->route('admin.projects.index')->with('success', 'Project created successfully');
    }

    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        $categories = Category::all();
        return view('admin.projects.edit', compact('project', 'categories'));
    }

    public function update(UpdateProjectRequest $request, Project $project)
    {

        $form_data = $request->validated();


        if ($request->hasFile('project_image')) {

            if (Str::startsWith($project->project_image, 'https') === false) {
                Storage::disk('public')->delete($project->project_image);
            }


            $path = Storage::disk('public')->put('project_image', $form_data['project_image']);
            $form_data['project_image'] = $path;
        }

        $form_data['slug'] = Project::generateSlug($form_data['name']);

        $project->update($form_data);

        return redirect()->route('admin.projects.index');
    }
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('admin.projects.index')->with('success', 'Progetto eliminato con successo');
    }
}
