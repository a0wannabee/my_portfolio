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
    $validatedData = $request->validate([
        'title' => 'required|string|min:5',
        'description' => 'required|string|min:10',
    ]);

    Project::create($validatedData);

    return redirect()->route('projects.index')->with('success', 'Data proyek berhasil ditambahkan.');
}

public function update(Request $request, Project $project)
{
    $validatedData = $request->validate([
        'title' => 'required|string|min:5',
        'description' => 'required|string|min:10',
    ]);

    $project->update($validatedData);

    return redirect()->route('projects.index')->with('success', 'Project Berhasil Diperbarui!');
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

    // Menghapus Project
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project berhasil dihapus.');
    }
}