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

            <button type="submit" class="btn btn-primary">Simpan Data</button>
        </form>
    </div>
@endsection