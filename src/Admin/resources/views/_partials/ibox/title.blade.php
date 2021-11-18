@php
    $collapse = isset($collapse) ? $collapse : true;
    $collapsed = false;
@endphp
<div class="ibox-title">
    <h5>{{ $title }}</h5>
    <div class="ibox-tools">
        @if ($collapse)
            <a class="collapse-link">
                <i class="fa fa-chevron-up"></i>
            </a>
        @endif
        @if (!empty($close))
            <a class="{{ !empty($closeClass) ? $closeClass : 'close-link' }}" data-name="{{ !empty($closeName) ? $closeName : '' }}">
                <i class="fa fa-times"></i>
            </a>
        @endif
    </div>
</div>