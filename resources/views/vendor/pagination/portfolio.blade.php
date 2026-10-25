{{-- View pagination custom portfolio (CSS di resources/css/app.css bagian Pagination) --}}
@if ($paginator->hasPages())
    <div class="pagination">
        {{-- Tombol sebelumnya --}}
        @if ($paginator->onFirstPage())
            <span class="page-link disabled">&laquo;</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="page-link" rel="prev">&laquo;</a>
        @endif

        {{-- Nomor halaman --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="page-link disabled">{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="page-link active">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="page-link">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Tombol berikutnya --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="page-link" rel="next">&raquo;</a>
        @else
            <span class="page-link disabled">&raquo;</span>
        @endif
    </div>
@endif
