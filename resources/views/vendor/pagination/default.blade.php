@if ($paginator->hasPages())
    <div class="search-result__pagination pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <a class="pagination__item ">&laquo;</a>
        @else
            <li class="pagination__item"><a href="{!! preg_replace(["/\?page=1$/", "/\&page=1$/"], "", $paginator->previousPageUrl()) !!}" rel="prev">&laquo;</a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span>{{ $element }}</span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="pagination__item pagination__item_active">{{ $page }}</span>
                    @else
                        <a class="pagination__item" href="{!! preg_replace(["/\?page=1$/", "/\&page=1$/"], "", $url) !!}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a class="pagination__item pagination_next" href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a>
        @else
            <a class="pagination__item">&raquo;</a>
        @endif
    </div>
@endif