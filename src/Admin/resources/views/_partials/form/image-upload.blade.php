<div>
@if(!empty($value))
    <img src="{{ $value }}" height="150px"/>
@else
    <img src="https://via.placeholder.com/150x150.png?text=?">
@endif
</div>
<br/>
<label for="file">
    <input type="file" name="{{$name ?? 'file'}}" id="file">
</label>
