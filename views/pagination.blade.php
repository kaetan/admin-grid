@if ($paginator->hasPages())
    @php
        $pages = $paginator->getUrlRange(max(1, $paginator->currentPage() - $paginationOffset), min($paginator->lastPage(), $paginator->currentPage() + $paginationOffset));
    @endphp
    <ul class="pagination" style="margin: 0">
        {{--<li class="footable-page-arrow disabled"><a data-page="first" href="#first">«</a></li>--}}
        @if (!$paginator->onFirstPage())
            <li class="footable-page-arrow"><a data-page="prev" href="{{ $paginator->url(1) }}">‹</a></li>
        @endif
        @foreach ($pages as $page => $url)
            <li class="footable-page @if ($page == $paginator->currentPage()) active @endif"><a data-page="{{ $page }}" href="{{ $url }}">{{ $page }}</a></li>
        @endforeach
        @if ($paginator->hasMorePages())
            <li class="footable-page-arrow"><a data-page="next" href="{{ $paginator->url($paginator->currentPage() + 1) }}">›</a></li>
        @endif
        {{--<li class="footable-page-arrow"><a data-page="last" href="#last">»</a></li>--}}
    </ul>
@endif