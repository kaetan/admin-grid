<div class="tabs-container">
    @if (!empty($tabs))
        @include('admin-grid::tabs')
    @endif
    <div class="tab-content">
        <div id="tab-1" class="tab-pane active">
            <div class="panel-body">

                @include('admin-grid::table-control-top')

                <div class="row">
                    <div class="col-lg-12">
                        @include('admin-grid::table')
                    </div>
                </div>

                @include('admin-grid::table-control-bottom')
            </div>
        </div>
    </div>
</div>