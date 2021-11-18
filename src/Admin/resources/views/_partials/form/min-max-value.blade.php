<div class="row">
        <div class="col-md-6">
            @include('_partials.form.label', [
                'label' => 'Мин.Сумма'
            ])
        </div>
        <div class="col-md-6">
            @include('_partials.form.label', [
                'label' => 'Макс.Cумма'
            ])
        </div>
    @if(!empty($value))
        @foreach($value as $interval)
            <div class="col-md-6">
                {!! !empty($interval) ? $interval->getMin() : null !!}
            </div>
            <div class="col-md-6">
                {!! !empty($interval) ? $interval->getMax() : null !!}
            </div>
        @endforeach
    @endif
 </div>

