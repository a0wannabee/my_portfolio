@extends('layout.app')

@section('title', 'Edit Project - Portfolio')

@section('content')
<h1>Edit Project</h1>

@if ($errors->any())
<div>
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="form-container">
    <form action="{{ route('projects.update', $project->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Judul Project</label>
            <input type="text" name="title" id="title" required value="{{ old('title', $project->title) }}">
        </div>

        <div class="form-group">
            <label for="description">Deskripsi</label>
            <textarea name="description" id="description" required>{{ old('description', $project->description) }}</textarea>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" required style="width: 100%; padding: 10px 12px; border: 1px solid #ccc; border-radius: 4px;">
                <option value="draft" @selected(old('status', $project->status) === 'draft')>Draft</option>
                <option value="published" @selected(old('status', $project->status) === 'published')>Published</option>
            </select>
        </div>

        <div style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="{{ route('projects.index') }}" class="btn" style="background-color: #6c757d; color: white; text-decoration: none; padding: 6px 12px; border-radius: 4px;">Batal</a>
            
            <!-- Form Delete yang disatukan layoutnya -->
            <button type="button" onclick="confirmDelete()" class="btn" style="background-color: #dc3545; color: white; border: none; cursor: pointer; padding: 6px 12px; border-radius: 4px;">Hapus</button>
        </div>
    </form>

    <!-- Form Delete Tersembunyi untuk eksekusi SweetAlert -->
    <form id="delete-form" action="{{ route('projects.destroy', $project->id) }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete() {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Data project ini akan dipindahkan ke trash.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form').submit();
                }
            });
        }
    </script>
</div>
@endsection