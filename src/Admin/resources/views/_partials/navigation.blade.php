<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <span><a href="/admin">
                            {{--<img alt="image" style="height: 32px;" src="/images/qiwi_logo.png">--}}
                         Serviko Admin
                    </a></span>
                    <br/>
                    <br/>
                    {{--<a data-toggle="dropdown" class="dropdown-toggle" href="#">--}}
                        {{--<span class="clear">--}}
                            {{--<span class="block m-t-xs">--}}
                                {{--<strong class="font-bold">{{ Auth::check() ? Auth::user()->email : ''}}</strong>--}}
                            {{--</span> <span class="text-muted text-xs block">Быстрое меню <b class="caret"></b></span>--}}
                        {{--</span>--}}
                    {{--</a>--}}
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        @if (\Illuminate\Support\Facades\Auth::check())
                            <li>
                                <a href="javascript:;" class="js-cache-clear">Очистить кэш</a>
                                <a href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Выйти</a>

                                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        @endif
                    </ul>
                </div>
                <div class="logo-element">
                    <a href="/">
                        Serviko
                    </a>
                </div>
            </li>

            @foreach ($menuItems as $item)
                @php($activeItem = !empty($item['active']))
            <li class="{{ $activeItem ? 'active' : '' }}">
                <a href="{{ $item['href'] }}">
                    <i class="fa {{ $item['icon'] ?? '' }}"></i>
                    <span class="nav-label">{{ $item['title'] }}</span>{!! !empty($item['children']) ? '<span class="fa arrow"></span>' : '' !!}
                    @if(!empty($item['hasDot']))
                        <div class="has-notify"></div>
                    @endif
                </a>
                @if (!empty($item['children']))
                    <ul class="nav nav-second-level collapse {{ $activeItem ? 'in' : ''}}">
                        @foreach ($item['children'] as $child)
                            <li class="{{ !empty($child['active']) ? 'active' : '' }}">
                                <a href="{{ $child['href'] }}"><i class="fa {{ $child['icon'] ?? '' }}"></i>{{ $child['title'] }}</a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </li>
            @endforeach
        </ul>
    </div>
</nav>
