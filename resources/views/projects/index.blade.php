@extends('layout.app')

@section('title', 'Daftar Project - Portfolio')

@section('content')
    <h1>Daftar Project</h1>

    <a href="{{ route('projects.create') }}" class="btn btn-primary" style="margin-bottom: 20px;">Tambah Project Baru</a>

    @if (session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <table>
        <thead>
            <tr>
                <th style="width: 8%;">No</th>
                <th style="width: 25%;">Judul Project</th>
                <th style="width: 42%;">Deskripsi</th>
                <th style="width: 15%;">Tanggal</th>
                <th style="width: 10%;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($projects ?? [] as $index => $project)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $project->title }}</td>
                    <td>{{ $project->description }}</td>
                    <td>{{ $project->created_at }}</td>
                    <td>
                        <a href="{{ route('projects.show', $project->id) }}" class="btn btn-detail">Detail</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center; color: #777;">Belum ada data project.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection