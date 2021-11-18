<div class="input-group clockpicker">
    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
    @include('_partials.form.text', [
         'type' => 'text',
         'name' =>  $name.(!empty($multiple) ? '[]' : ''),
         'value' => $value ?? '',
         'class' => 'js-clockpicker '.(!empty($class) ? $class : null),
         'placeholder' => $placeholder ?? '',
         'attributes' => $attributes ?? [],
     ])

</div>
@include('_partials.edit.error')