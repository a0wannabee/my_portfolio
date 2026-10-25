@extends('layouts.app')

@section('title', 'Trash Project - Portfolio')

@section('content')
    <h1>Trash Project</h1>

    <a href="{{ route('projects.index') }}" class="btn" style="background-color: #6c757d; color: white; margin-bottom: 20px;">Kembali ke Daftar</a>

    <table>
        <thead>
            <tr>
                <th style="width: 6%;">No</th>
                <th style="width: 25%;">Judul Project</th>
                <th style="width: 34%;">Deskripsi</th>
                <th style="width: 15%;">Dihapus Pada</th>
                <th style="width: 20%;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($projects as $index => $project)
                <tr>
                    <td>{{ $projects->firstItem() + $index }}</td>
                    <td>{{ $project->title }}</td>
                    <td>{{ $project->description }}</td>
                    <td>{{ $project->deleted_at }}</td>
                    <td>
                        <div style="display: flex; gap: 6px; flex-wrap: wrap;">
                            <form action="{{ route('projects.restore', $project->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-success" style="padding: 6px 12px; font-size: 13px;">Restore</button>
                            </form>

                            <form action="{{ route('projects.force-delete', $project->id) }}" method="POST" class="force-delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn" style="background-color: #dc3545; color: white; padding: 6px 12px; font-size: 13px;">Hapus Permanen</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" style="text-align: center; color: #777;">Trash kosong.</td>
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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.querySelectorAll('.force-delete-form').forEach((form) => {
            form.addEventListener('submit', (event) => {
                event.preventDefault();
                Swal.fire({
                    title: 'Hapus permanen?',
                    text: "Data project ini tidak bisa dikembalikan lagi!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ef4444',
                    cancelButtonColor: '#6b7280',
                    confirmButtonText: 'Ya, Hapus Permanen!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection