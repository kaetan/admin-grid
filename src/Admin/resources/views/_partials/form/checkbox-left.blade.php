

@include('_partials.form.checkbox-filter', [
'name' => $name,
'value' => get_value($name),
])

<label class="filter-label">
    @include('_partials.form.label', [
    'for' => $name,
    'label' => $title
    ])
</label>