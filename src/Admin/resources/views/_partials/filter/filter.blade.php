<div class="ibox  js-filter-container">
    {{--class="ibox {{ $hidden ? 'collapsed' : '' }} js-filter-container" data-cookie="{{ $filterCookie }}"
     data-hidden="{{ $hidden }}"--}}
    <div class="ibox-title">
        <h5>Фильтр</h5>
        <div class="ibox-tools">
            <a class="collapse-link js-filter-minimize">
                <i class="fa fa-chevron-down"></i>
            </a>
        </div>
    </div>
    <div class="ibox-content">
        <form method="GET" action="{!! assemble_url() !!}">
            @isset($filters)
                    @php($filterCounter = 0)
                    @foreach($filters as $filter)
                                @if($loop->first)
                                   <div class="row">
                                @endif
                            @php($filterSize = $filter->getOption('size') ?? 1)
                            @php( $filterCounter += 2 * $filterSize )
                         <div class="col-md-{{ 2 * $filterSize }}">
                             <div class="form-group">
                                     @if($filter->getType() != \App\Entity\Form\Field::TYPE_CHECKBOX_LEFT)
                                     @include('_partials.form.label', [
                                         'for' => $filter->getName(),
                                         'label' => $filter->getTitle(),
                                     ])
                                     {!! $filter->render() !!}
                                     @else
                                     @include('_partials.form.checkbox-filter', [
                                        'name' => $filter->getName(),
                                        'value' => get_value($filter->getName()),
                                        ])

                                     <label class="filter-label">
                                         @include('_partials.form.label', [
                                         'for' => $filter->getName(),
                                         'label' => $filter->getTitle()
                                         ])
                                     </label>
                                     @endif
                             </div>
                         </div>
                            @if($loop->last)
                                </div>
                            @else
                                 @if ($filterCounter >= 12)
                                    </div>
                                    <div class="row">
                                    @php( $filterCounter = 0 )
                                @endif
                            @endif
                     @endforeach
             @endisset
             @section('filters')

             @show
             <div class="form-group clearfix">
                 <div class="pull-right">
                     <a href="{{ url()->current() }}">
                         <button type="button" class="btn btn-default js-reset-form">Сбросить</button>
                     </a>
                     <button class="btn btn-primary js-btn-primary--ripple-out">Применить</button>
                 </div>
             </div>

         </form>
     </div>
 </div>
