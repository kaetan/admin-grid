<!-- Хлебные крошки-->

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>{{ !empty($title) ? $title : 'Заголовок страницы' }}</h2>
        <ol class="breadcrumb">
            @if ($breadcrumbs)
                @foreach ($breadcrumbs as $breadcrumb)
                    <li class="breadcrumbs__item">
                        @if (!$loop->last)
                            <a class="breadcrumbs__link" href="{{ $breadcrumb->url }}"><span class="underline">{{ $breadcrumb->title }}</span></a>
                        @else
                            <span class="breadcrumbs__link" href="javascript:;"><span class="">{{ meta_get_breadcrumb($breadcrumb->title) }}</span></span>
                        @endif
                    </li>
                @endforeach
            @endif
        </ol>
    </div>
    <div class="col-lg-2">

    </div>
</div>
