<div class="row" style="padding: 15px 0;">
    <div class="col-sm-2">
        @if (!empty($addUrl))
            <a href="{{ $addUrl }}" class="btn btn-primary btn-sm">Добавить</a>
        @endif
    </div>
    @if ($paginator)
        <div class="col-sm-7" style="text-align: center;">
            @include('admin-grid::pagination')
        </div>
        <div class="col-sm-3">
            @include('admin-grid::sizes')
        </div>
    @endif
</div>