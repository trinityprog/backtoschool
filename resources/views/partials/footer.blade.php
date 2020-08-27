<footer>
    <div class="container column">
        <div class="row text din small">
            <div class="column">
                <div class="row">
{{--                    @if($type == 'magnum')--}}
                        <i class="icon magnum"></i>
                        <div>@lang('index.footer.period')</div>
{{--                    @elseif($type = 'small')--}}
{{--                        <i class="icon small"></i>--}}
{{--                        <div>@lang('index.footer.period_small')</div>--}}
{{--                    @endif--}}

                </div>
            </div>
            <div class="column">
                <div class="row">
                    <div>
                        @lang('index.footer.join')
                    </div>
                    <a href="#">
                        <i class="icon vk"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="column text din tiny">
            <div>@lang('index.footer.rights')</div>
            <div class="row">
                @lang('index.footer.links')
            </div>
        </div>
    </div>
</footer>
