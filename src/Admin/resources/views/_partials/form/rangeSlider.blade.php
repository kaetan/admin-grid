<input type="text" class="js-range-slider" name={!! $name !!} value=""
       data-type="double"
       data-min="0"
       data-max="300000"
       data-from={!! strstr($value, ';', true) !!}
       data-to={!! substr($value, strrpos($value,";")+1); !!}
       data-grid="true"
       data-skin="round"
/>