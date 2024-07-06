<?php

namespace App\Http\Controllers;

use App\Models\project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = project::orderBy('id')->paginate(2);
        return view('dashboard.projects.index', compact('projects'))
            ->with('i', (request()->input('page', 1) - 1) * 2);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'brief' => 'required',
            'photo' => 'required'
        ], [
            'title.required' => 'Project Title is required',
            'brief.required' => 'Project Brief is required',
            'photo.required' => 'Project Photo is required',
            'image.image' => 'Please upload a valid image'
        ]);

        $image = $request->file('photo');
        $imageName = time() . '.' . $image->getClientOriginalName();
        $request->photo = $imageName;

        $image->move(public_path('site/images/portfolio/'), $imageName);
        $project = new project();
        $project->title = $request->title;
        $project->brief = $request->brief;
        $project->photo = $imageName;
        $project->save();
        return redirect()->route('projects.index')
            ->with('success', 'Project created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(project $project)
    {
        return view('dashboard.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(project $project)
    {
        return view('dashboard.projects.edit', compact('project'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, project $project)
    {
        $request->validate([
            'title' => 'required',
            'brief' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ], [
            'title.required' => 'Project Title is required',
            'brief.required' => 'Project Brief is required',
            'photo.required' => 'Project Photo is required',
            'image.image' => 'Please upload a valid image'
        ]);

        $project->title = $request->title;
        $project->brief = $request->brief;
        if ($request->photo != null){
            unlink(public_path('site/images/portfolio') . '/' . $project->photo);
            $image = $request->file('photo');
            $imageName = time() . '.' . $image->getClientOriginalName();

            $image->move(public_path('site/images/portfolio/'), $imageName);
            $project->photo = $imageName;
        }
        $project->save();
        return redirect()->route('projects.index')
            ->with('success', 'Project updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(project $project)
    {
        unlink(public_path('site/images/portfolio/') . '/' . $project->photo);
        $project->delete();
        return redirect()->route('projects.index')
            ->with('success', 'Project deleted successfully');
    }


}
