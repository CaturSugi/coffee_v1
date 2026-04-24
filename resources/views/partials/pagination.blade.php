@if ($paginator->hasPages())
    <nav class="pagination-container" style="display: flex; align-items: center; justify-content: center; gap: 8px; margin-top: 30px;">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="pagination-item disabled" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; background: var(--gray-50); color: var(--gray-300); border-radius: 12px; cursor: not-allowed; border: 1px solid var(--gray-100);">←</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="pagination-item" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; background: #fff; color: var(--dark-700); border-radius: 12px; text-decoration: none; border: 1px solid var(--gray-200); transition: all 0.2s;">←</a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span class="pagination-item disabled" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; color: var(--gray-400);">{{ $element }}</span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="pagination-item active" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; background: var(--brand-500); color: #fff; border-radius: 12px; font-weight: 700; border: 1px solid var(--brand-500);">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="pagination-item" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; background: #fff; color: var(--dark-700); border-radius: 12px; text-decoration: none; border: 1px solid var(--gray-200); transition: all 0.2s;">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="pagination-item" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; background: #fff; color: var(--dark-700); border-radius: 12px; text-decoration: none; border: 1px solid var(--gray-200); transition: all 0.2s;">→</a>
        @else
            <span class="pagination-item disabled" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; background: var(--gray-50); color: var(--gray-300); border-radius: 12px; cursor: not-allowed; border: 1px solid var(--gray-100);">→</span>
        @endif
    </nav>
    <div style="text-align: center; margin-top: 12px; font-size: 12px; color: var(--gray-400); font-weight: 600;">
        Menampilkan {{ $paginator->firstItem() }} - {{ $paginator->lastItem() }} dari {{ $paginator->total() }} hasil
    </div>
@endif

<style>
    .pagination-item:hover:not(.active):not(.disabled) {
        background: var(--brand-50) !important;
        color: var(--brand-600) !important;
        border-color: var(--brand-200) !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.05);
    }
</style>
