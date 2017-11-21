@if ($showPaginator)
    @include('admin-grid::table-control-top')
@endif

<div class="row">
    <div class="col-lg-12">
        @include('admin-grid::table')
    </div>
</div>

@if ($showPaginator)
    @include('admin-grid::table-control-bottom')
@endif