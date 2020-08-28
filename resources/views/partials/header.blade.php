<header>
    <svg class="burger" width="80" height="80" viewBox="0 0 80 80" fill="none" xmlns="http://www.w3.org/2000/svg">
        <line x2="80"/><line x2="80"/><line x2="80"/>
    </svg>
    <div class="container row header text small">
        <div class="slide"></div>
            <a class="icon button text header big mobile"
               href="@if(Auth::check()){{ url("/profile") }}
                    @else #authorization @endif">
                <i class="icon check"></i>
                @lang('index.actions.upload')
            </a>
        <a href="{{ url('/#mechanics') }}">@lang('index.header.about')</a>
        <a href="{{ url('/#prizes') }}">@lang('index.header.prizes')</a>
        <a href="{{ url('/#winners') }}">@lang('index.header.winners')</a>
        <a href="{{ url('/#faq') }}">@lang('index.faq.header')</a>
        <a href="@if(Auth::check()){{ url("/profile") }}
                @else #authorization @endif">
            @lang('index.header.profile')
        </a>
        @if(Auth::check())
            <a href="{{ url("/get-logout") }}">@lang('index.header.logout')</a>
        @endif
    </div>
</header>
