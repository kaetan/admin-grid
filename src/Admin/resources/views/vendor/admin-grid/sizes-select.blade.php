<label>
    <select name="size" class="form-control input-sm js-pagination-size">
        @php
            $sizes = ['10', '20', '32', '50', '100', '200', 'all'];
        @endphp
        @foreach($sizes as $sizeValue)
            <option value="{{ assemble_url(null, ['size' => $sizeValue]) }}" @if ($size == $sizeValue) selected="selected" @endif>{{ $sizeValue == 'all' ? 'Все' : $sizeValue }}</option>
        @endforeach
    </select>
</label>
