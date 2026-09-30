@extends('layout.app')

@section('title', 'Edit Project - Portfolio')

@section('content')
    <h1>Edit Project</h1>

    @if ($errors->any())
        <div class="alert-error">
            <ul class="error-list">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="form-container">
        <form action="{{ route('projects.update', $project->id) }}" method="POST">
            @csrf
            @method('PUT') <!-- Method Spoofing untuk PUT -->
            
            <div class="form-group">
                <label for="title">Judul Project</label>
                <input type="text" name="title" id="title" required value="{{ old('title', $project->title) }}">
            </div>

            <div class="form-group">
                <label for="description">Deskripsi</label>
                <textarea name="description" id="description" required>{{ old('description', $project->description) }}</textarea>
            </div>

            <div style="display: flex; gap: 10px;">
                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="{{ route('projects.index') }}" class="btn" style="background-color: #6c757d; color: white;">Batal</a>
            </div>
        </form>
    </div>
@endsection