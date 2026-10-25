<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Project::query();

        // Local scope search()
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Local scope published() / draft()
        if ($request->status === 'published') {
            $query->published();
        } elseif ($request->status === 'draft') {
            $query->draft();
        }

        // Jumlah data per halaman: hanya boleh 5, 10, atau 25
        $perPage = (int) $request->input('per_page', 10);
        if (! in_array($perPage, [5, 10, 25], true)) {
            $perPage = 10;
        }

        // orderByDesc('id') sebagai pengurut kedua, karena data seeder punya created_at yang sama
        // withQueryString() agar search, status, dan per_page ikut saat pindah halaman
        $projects = $query->latest()->orderByDesc('id')->paginate($perPage)->withQueryString();

        // Retrieving aggregates
        $totalProjects = Project::count();
        $publishedProjects = Project::published()->count();
        $trashedProjects = Project::onlyTrashed()->count();
        $latestProject = Project::latest()->orderByDesc('id')->first();

        return view('projects.index', compact(
            'projects',
            'totalProjects',
            'publishedProjects',
            'trashedProjects',
            'latestProject',
            'perPage'
        ));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|min:5|max:200',
            'description' => 'required|string|min:10',
            'status' => 'required|in:draft,published',
        ]);

        // Aman, hanya field yang sudah divalidasi
        Project::create($validatedData);

        return redirect()->route('projects.index')->with('success', 'Data proyek berhasil ditambahkan.');
    }

    public function update(Request $request, Project $project)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|min:5|max:200',
            'description' => 'required|string|min:10',
            'status' => 'required|in:draft,published',
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

    // Menghapus Project (soft delete, pindah ke trash)
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project dipindahkan ke trash.');
    }

    // Menampilkan Project yang sudah di-soft delete
    public function trash()
    {
        $projects = Project::onlyTrashed()->latest('deleted_at')->paginate(10);

        return view('projects.trash', compact('projects'));
    }

    // Mengembalikan Project dari trash
    public function restore($id)
    {
        $project = Project::onlyTrashed()->findOrFail($id);
        $project->restore();

        return redirect()->route('projects.trash')->with('success', 'Project berhasil dipulihkan.');
    }

    // Menghapus Project secara permanen
    public function forceDelete($id)
    {
        $project = Project::onlyTrashed()->findOrFail($id);
        $project->forceDelete();

        return redirect()->route('projects.trash')->with('success', 'Project berhasil dihapus permanen.');
    }
}