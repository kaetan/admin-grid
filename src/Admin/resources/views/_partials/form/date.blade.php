<div class="input-group date">
    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
    @include('_partials.form.text', [
         'type' => 'text',
         'name' =>  $name.(!empty($multiple) ? '[]' : ''),
         'value' => $value ?? '',
         'class' => 'js-datepicker '.(!empty($class) ? $class : null),
         'placeholder' => $placeholder ?? '',
         'attributes' => $attributes ?? [],
         'noError' => true
     ])
</div>
@include('_partials.edit.error')