@extends('layouts.app')

@section('title', 'Daftar Project - Portfolio')

@section('content')
    <h1>Daftar Project</h1>

    <!-- Ringkasan data (Retrieving Aggregates) -->
    <p style="color: #555; margin-bottom: 15px;">
        Total: <strong>{{ $totalProjects }}</strong> project
        &middot; Published: <strong>{{ $publishedProjects }}</strong>
        &middot; Di trash: <strong>{{ $trashedProjects }}</strong>
        @if($latestProject)
            &middot; Terbaru: <strong>{{ $latestProject->title }}</strong>
        @endif
    </p>

    <div style="display: flex; gap: 10px; flex-wrap: wrap; margin-bottom: 20px;">
        <a href="{{ route('projects.create') }}" class="btn btn-primary">Tambah Project Baru</a>
        <a href="{{ route('projects.trash') }}" class="btn" style="background-color: #6c757d; color: white;">Trash ({{ $trashedProjects }})</a>
    </div>

    <!-- Pencarian & filter status (Local Scope) -->
    <form action="{{ route('projects.index') }}" method="GET" style="display: flex; gap: 10px; flex-wrap: wrap;">
        <input type="text" name="search" placeholder="Cari judul project..." value="{{ request('search') }}" style="padding: 8px 12px; border: 1px solid #ccc; border-radius: 4px;">
        <select name="status" style="padding: 8px 12px; border: 1px solid #ccc; border-radius: 4px;">
            <option value="">Semua Status</option>
            <option value="published" @selected(request('status') === 'published')>Published</option>
            <option value="draft" @selected(request('status') === 'draft')>Draft</option>
        </select>
        <button type="submit" class="btn btn-primary">Cari</button>
        @if(request()->hasAny(['search', 'status']))
            <a href="{{ route('projects.index') }}" class="btn" style="background-color: #6c757d; color: white;">Reset</a>
        @endif
    </form>

    <table>
        <thead>
            <tr>
                <th style="width: 6%;">No</th>
                <th style="width: 24%;">Judul Project</th>
                <th style="width: 35%;">Deskripsi</th>
                <th style="width: 10%;">Status</th>
                <th style="width: 15%;">Tanggal</th>
                <th style="width: 10%;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($projects as $index => $project)
                <tr>
                    <td>{{ $projects->firstItem() + $index }}</td>
                    <td>{{ $project->title }}</td>
                    <td>{{ Str::limit($project->description, 50) }}</td>
                    <td>{{ ucfirst($project->status) }}</td>
                    <td>{{ $project->created_at?->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('projects.show', $project->id) }}" class="btn btn-detail">Detail</a>
                        <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-detail">Edit</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" style="text-align: center; color: #777;">Belum ada data project.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @if($projects->hasPages())
        <div style="display: flex; gap: 10px; align-items: center;">
            @if($projects->onFirstPage())
                <span class="btn" style="background-color: #e0e0e0; color: #888;">&laquo; Sebelumnya</span>
            @else
                <a href="{{ $projects->previousPageUrl() }}" class="btn btn-primary">&laquo; Sebelumnya</a>
            @endif

            <span>Halaman {{ $projects->currentPage() }} dari {{ $projects->lastPage() }}</span>

            @if($projects->hasMorePages())
                <a href="{{ $projects->nextPageUrl() }}" class="btn btn-primary">Berikutnya &raquo;</a>
            @else
                <span class="btn" style="background-color: #e0e0e0; color: #888;">Berikutnya &raquo;</span>
            @endif
        </div>
    @endif
@endsection