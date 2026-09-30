@extends('layout.app')

@section('title', $project->title . ' - Portfolio')

@section('content')
    <div class="form-container" style="max-width: 800px;">
        <h1 style="margin-bottom: 10px;">{{ $project->title }}</h1>
        <small style="color: #666; display: block; margin-bottom: 20px;">Tanggal Dibuat: {{ $project->created_at }}</small>
        
        <p style="font-size: 16px; line-height: 1.8; margin-bottom: 30px;">{{ $project->description }}</p>

        <div style="display: flex; gap: 10px; align-items: center;">
            <a href="{{ route('projects.edit', $project->id) }}" class="btn btn-success">Edit</a>
            
            <form action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus project ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn" style="background-color: #e3342f; color: white;">Delete</button>
            </form>

            <a href="{{ route('projects.index') }}" class="btn" style="background-color: #6c757d; color: white; margin-left: auto;">Back to List</a>
        </div>
    </div>
@endsection