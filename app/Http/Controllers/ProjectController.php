<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|max:200',
        'description' => 'required',
    ]);

    $project = new Project();
    $project->title = $request->title;
    $project->description = $request->description;
    $project->save();

    return redirect()->route('projects.index')->with('success', 'Project berhasil ditambahkan.');
}

    // Menampilkan Halaman Detail Project
    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    // Menampilkan Halaman Form Edit Project
    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    // Menyimpan Perubahan Edit Project
    public function update(Request $request, Project $project)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $project->update($validatedData);

        return redirect()->route('projects.index')->with('success', 'Project berhasil diperbarui.');
    }

    // Menghapus Project
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project berhasil dihapus.');
    }
}