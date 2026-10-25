@extends('layouts.app')

@section('title', $project->title . ' - Portfolio')

@section('content')
<div class="form-container">
    <h1 style="margin-top: 0; margin-bottom: 10px;">{{ $project->title }}</h1>
    <p style="color: #6c757d; font-size: 0.9rem; margin-bottom: 20px;">
        Tanggal Dibuat: {{ $project->created_at }}
    </p>

    <div style="margin-bottom: 30px; line-height: 1.6; font-size: 1.05rem;">
        {{ $project->description }}
    </div>

    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px; border-top: 1px solid #eee; padding-top: 20px;">
        <!-- Kelompok Tombol Aksi (Edit & Delete) -->
        <div style="display: flex; gap: 10px; align-items: center;">
            <a href="{{ route('projects.edit', $project->id) }}" class="btn" style="background-color: #28a745; color: white; text-decoration: none; padding: 8px 16px; border-radius: 4px; font-weight: 500;">Edit</a>
            
            <button type="button" onclick="confirmDelete()" class="btn" style="background-color: #dc3545; color: white; border: none; cursor: pointer; padding: 8px 16px; border-radius: 4px; font-weight: 500;">Hapus</button>
        </div>

        <!-- Tombol Kembali -->
        <div>
            <a href="{{ route('projects.index') }}" class="btn" style="background-color: #6c757d; color: white; text-decoration: none; padding: 8px 16px; border-radius: 4px; font-weight: 500;">Kembali</a>
        </div>
    </div>

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
                text: "Data project ini akan dihapus secara permanen!",
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