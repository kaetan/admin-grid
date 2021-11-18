<div class="row" style="padding: 15px 0;">
    <div class="col-sm-6" style="text-align: center;">
    @include('admin-grid::index-buttons', ['indexButtons' => $indexButtons])
    </div>
    @if($showPaginator)
        <div class="col-sm-6">
            @include('admin-grid::sizes')
        </div>
    @endif
</div>
