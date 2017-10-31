<div class="row" style="padding: 15px 0;">
    <div class="col-sm-2">
        <button type="button" class="btn btn-primary btn-sm">Добавить</button>
    </div>
    <div class="col-sm-7" style="text-align: center;">
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
    </div>
    <div class="col-sm-3">
        <div class="pull-right">
            21 из 284&nbsp;&nbsp;&nbsp;
            <label>
                <select name="size" class="form-control input-sm js-pagination-size">
                    @foreach($sizes as $size)
                        <option value="{{ assemble_url(null, ['size' => $size]) }}" @if (request('size') == $size) selected="selected" @endif>{{ $size == 'all' ? 'Все' : $size }}</option>
                    @endforeach
                </select>
            </label>
        </div>
    </div>
</div>