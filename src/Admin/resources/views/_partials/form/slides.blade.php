<div class="js-slides-upload__error slides-upload__error"></div>
<div>
    <div class="js-slides-images slides-upload">
        @if(!empty($value))
            @foreach($value as $slide)
                @include('_partials.form.slider.slide', [
                    'imagePath' => $slide,
                    'name' => $name,
                ])
            @endforeach
        @endif
        @include('_partials.form.slider.slideUpload')
        @if(!empty($oldImages = request()->old('slide-new')))
            @foreach($oldImages as $oldImage)
                @include('_partials.form.slider.slide', [
                    'imagePath' => $oldImage,
                    'name' => 'slide-new',
                ])
            @endforeach
        @endif
    </div>
</div>
<br/>
<label for="file">
    <input type="file" id="file" class="js-slides-upload-input">
</label>
