<div class="form-group form-group--middle ">
@if ($uploadImage)
        <div class="col-sm-3">
        </div>
            <div class="col-sm-4">
                <img   alt="image" style="max-height: 400px;" src="{{ \Illuminate\Support\Facades\Storage::url('image/cardId-' . $cardId ) }}">
            </div>
@else
        <div class="col-sm-4">
        </div>
    <label class="col-sm-8" style="margin-right: 95px">
        Изображение не загружено
    </label>
@endif
</div>
