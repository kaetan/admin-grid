@if (!empty($indexButtons))
    @foreach($indexButtons as $indexButton)
        @if(!$loop->first)
            <a href="{{ $indexButton->getUrl() }}" class="m-l btn btn-primary btn-sm pull-left">{{$indexButton->getText()}}</a>
        @else
            <a href="{{ $indexButton->getUrl() }}" class="btn btn-primary btn-sm pull-left">{{$indexButton->getText()}}</a>
        @endif
    @endforeach
@endif
