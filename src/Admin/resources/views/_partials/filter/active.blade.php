@include('_partials.form.label', [
    'for' => 'active',
    'label' => 'Активность'
])

@include('_partials.form.select', [
    'options' => get_options(Options::ACTIVE),
    'placeholder' => 'Не выбрано',
    'name' => 'active',
    'class' => 'js-chosen',
    'multiple' => true,
    'values' => get_value('active'),
    'value' => null,
])