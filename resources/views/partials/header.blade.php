<header>
    <svg class="burger" width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
        <line x2="80"/><line x2="80"/><line x2="80"/>
    </svg>
    <div class="container row header text small impact">
        <div class="slide"></div>
{{--        <div class="lang row mobile">--}}
{{--            <a href="{{ url("/language/kk") }}">Қаз</a>|--}}
{{--            <a href="{{ url("/language/ru") }}">рус</a>--}}
{{--        </div>--}}
{{--        <a href="#">@lang('index.not_magnum')</a>--}}
{{--        @if($type == 'magnum')--}}
            <a class="icon button text impact header big mobile"
               href="@if(Auth::check()){{ url("/profile") }}
                    @else #authorization @endif">
                <i class="icon check"></i>
                @lang('index.actions.upload')
            </a>
{{--        @else--}}

{{--        @endif--}}
        <a href="{{ url('/#mechanics') }}">@lang('index.header.about')</a>
        <a href="{{ url('/#prizes') }}">@lang('index.header.prizes')</a>
        <a href="{{ url('/#winners') }}">@lang('index.header.winners')</a>

        <a href="{{ url('/#faq') }}">@lang('index.faq.header')</a>

{{--        @if($type == 'magnum')--}}
            <a href="@if(Auth::check()){{ url("/profile") }}
                    @else #authorization @endif">
                @lang('index.header.profile')
            </a>
{{--        @else--}}
{{--            <a href="@if(Auth::check() && Auth::user()->hasPermission($type))#slip--}}
{{--            @else #authorization @endif">--}}
{{--                @lang('index.header.profile')--}}
{{--            </a>--}}
{{--        @endif--}}



        @if(Auth::check())
            <a href="{{ url("/get-logout") }}">@lang('index.header.logout')</a>
        @endif
{{--        @if(request()->is('profile'))--}}
{{--            <div class="lang row desktop">--}}
{{--                <a href="{{ url("/language/kk") }}">Қаз</a>|--}}
{{--                <a href="{{ url("/language/ru") }}">рус</a>--}}
{{--            </div>--}}
{{--        @endif--}}
    </div>
</header>
