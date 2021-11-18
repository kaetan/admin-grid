<div class="form-group">
    @include('_partials.form.label', [
        'for' => 'name',
        'label' => !empty($updateDate) ? 'Дата изменения' : 'Дата создания'
    ])

    <div class="row">
        <div class="col-md-6">
            @include('_partials.form.date', [
                'name' => !empty($updateDate) ? 'updated_at_from' : 'created_at_from',
                'value' => get_value(!empty($updateDate) ? 'updated_at_from' : 'created_at_from'),
                'placeholder' => 'От',
            ])
        </div>
        <div class="col-md-6">
            @include('_partials.form.date', [
                'name' => !empty($updateDate) ? 'updated_at_to' : 'created_at_to',
                'value' => get_value(!empty($updateDate) ? 'updated_at_to' : 'created_at_to'),
                'placeholder' => 'До'
            ])
        </div>
    </div>
</div>