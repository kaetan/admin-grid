<label for="file">
    @php($fileName = $name ?? 'file')
    <input type="file" name="{{$fileName}}" id="file" class="{{ $class ?? '' }}" {{ $multiple ?? '' }}>
</label>
@if (!empty($errors) && !empty($fileName) && $errors->has(arrNotationWithoutDotNotation($fileName)))
    <div class="form-group has-error">
        <span class="help-block">
            <strong>{{ $errors->first(arrNotationWithoutDotNotation($fileName)) }}</strong>
        </span>
    </div>
@endif
