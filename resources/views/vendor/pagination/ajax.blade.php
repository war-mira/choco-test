@if ($paginator->hasPages())
    <ul class="pagination pagination-lg">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li><a>&laquo;</a></li>
        @else
            <li><a href="#" class="page-link" data-page="{{$paginator->currentPage()-1}}">&laquo;</a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li><span>{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active"><a>{{ $page }}</a></li>
                    @else
                        <li class=""><a href="#" class="page-link" data-page="{{$page}}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li><a href="#" class="page-link" data-page="{{$paginator->currentPage()+1}}">&raquo;</a></li>
        @else
            <li><a>&raquo;</a></li>
        @endif
    </ul>
@endif
<script>
    $('.page-link').click(function () {
        currPage = $(this).data('page');
        infinitePaginator.loadNextPage(getSearchRequestParams());
    });
</script>
