@extends('layout.app')

@section('title', 'Tambah Project - Portfolio')

@section('content')
    <h1>Tambah Project Baru</h1>

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
        <form action="{{ route('projects.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Judul Project</label>
                <input type="text" name="title" id="title" required value="{{ old('title') }}">
            </div>

            <div class="form-group">
                <label for="description">Deskripsi</label>
                <textarea name="description" id="description" required>{{ old('description') }}</textarea>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" required style="width: 100%; padding: 10px 12px; border: 1px solid #ccc; border-radius: 4px;">
                    <option value="draft" @selected(old('status', 'draft') === 'draft')>Draft</option>
                    <option value="published" @selected(old('status') === 'published')>Published</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Simpan Data</button>
        </form>
    </div>
@endsection