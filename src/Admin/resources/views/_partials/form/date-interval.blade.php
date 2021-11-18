    <div class="row">
        <div class="col-md-6">
            @include('_partials.form.date', [
                'name' => $name . '_from',
                'value' => get_value($name . '_from'),
                'placeholder' => 'От',
            ])
        </div>
        <div class="col-md-6">
            @include('_partials.form.date', [
                'name' => $name . '_to',
                'value' => get_value($name . '_to'),
                'placeholder' => 'До'
            ])
        </div>
    </div>
    @include('_partials.edit.error')