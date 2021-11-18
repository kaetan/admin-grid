@include('admin-grid::table-control-top', [
    'indexButtons' => $grid->getIndexButtons(),
    'showPaginator' => !empty($showPaginator)
])

<div class="row">
    <div class="col-lg-12">
        @include('admin-grid::table')
    </div>
</div>

@if ($showPaginator)
    @include('admin-grid::table-control-bottom', ['actionButtonVisibility' => $grid->getActionButtonVisibility(), 'pagesUrl' => $grid->getPagesUrl()])
@endif
