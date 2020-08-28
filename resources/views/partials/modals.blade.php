@if(!Auth::check())
    <div class="remodal" data-remodal-id="registration">
        <button data-remodal-action="close" class="remodal-close"></button>
        <form action="{{ url("/registration") }}" method="POST" class="form column text din medium">
            @csrf
            <h1 class="text impact big header">@lang('index.modals.reg.header')</h1>
            <div class="column">
                <div class="input @error('name') error @enderror">
                    <input type="text" name="name" placeholder="@lang('index.form.name')" class="@error('name') error @enderror" value="{{ old('name') }}">
                </div>
                <span class="text error tiny">
                    @error('name') {{ $message }} @enderror
                </span>
            </div>
            <div class="column">
                <div class="input @error('phone') error @enderror">
                    <input type="tel" name="phone" placeholder="+374 XX XX XX XX" value="{{ old('phone') }}">
                </div>
                <span class="text error tiny">
                    @error('phone') {{ $message }} @enderror
                </span>
            </div>
            <button class="button text impact">@lang('index.modals.reg.action')</button>
        </form>
        <p class="text din tiny">
            @lang('index.modals.reg.text')
        </p>
        <div class="bottom column text din medium header">
            @lang('index.modals.reg.bottom')
        </div>
    </div>

    <div class="remodal" data-remodal-id="authorization">
        <button data-remodal-action="close" class="remodal-close"></button>
        <form action="{{ url("/authorization") }}" method="POST" class="form column text medium">
            @csrf
{{--            <input type="hidden" name="type" value="{{ $type }}">--}}
            <h1 class="text big header">@lang('index.modals.auth.header')</h1>
            <div class="column">
                <div class="input @error('phone') error @enderror">
                    <input type="tel" name="phone" placeholder="+374 XX XX XX XX" value="{{ old('phone') }}">
                </div>
                <span class="text error tiny">
                    @error('phone') {{ $message }} @enderror
                </span>
            </div>
            <button class="button text">@lang('index.modals.auth.action')</button>
        </form>
        <div class="bottom column text din medium header">
            @lang('index.modals.auth.bottom')
        </div>
    </div>



@else
    <div class="remodal text header" data-remodal-id="check-success">
        <button data-remodal-action="close" class="remodal-close"></button>
        @lang('index.modals.check')

{{--        @if($type == 'magnum')--}}
            <a class="icon button text impact g-trigger-register" href="#" data-remodal-action="close">
                <i class="icon check"></i>
                @lang('index.actions.upload')
            </a>
{{--        @elseif($type == 'small')--}}
            <a class="button text impact header big g-trigger-register" href="#check">
                @lang('index.actions.register_check')
            </a>
{{--        @endif--}}

    </div>

{{--    @if($type == 'small')--}}
        <div class="remodal text header" data-remodal-id="check">
            <button data-remodal-action="close" class="remodal-close"></button>
            <div class="form-wrapper column">
                <form class="form text medium din column" action="{{ url('/check') }}">
                    @csrf
{{--                    <input type="hidden" value="{{ $type }}">--}}
                    <h1 class="text impact header">Регистрация чека</h1>
                    <h2 class="text din header small">Для участия в Акции необходимо зарегистрировать <span class="text yellow">номер чека и номер кассы</span></h2>
                    <div class="input labelled">
                        <label for="check">1</label>
                        <input type="text" name="check" placeholder="Номер чека" id="check">
                    </div>
                    <div class="input labelled">
                        <label for="cash">2</label>
                        <input type="text" name="cash" placeholder="Номер кассы" id="cash">
                    </div>
                    <button type="submit" class="button text header g-trigger-register">
                        @lang('index.actions.register')
                    </button>
                </form>
                <div class="text medium header alert din">Обязательно сохрани чек и слип-чек</div>
            </div>
        </div>

{{--    @endif--}}

{{--    @if($type != 'magnum')--}}
        <div class="remodal text header" data-remodal-id="profile">
            <button data-remodal-action="close" class="remodal-close"></button>
            <div class="top column">
                <h1 class="text impact header">{{ Auth::user()->email }}</h1>
                <h2 class="text impact header medium">мои чеки из  <i class="icon small"></i></h2>
                <div class="text alert din small header">Обязательно сохраняй зарегистрированные чеки и слип-чеки</div>
            </div>
            <div class="text din small header column table">
                <div class="text impact row head">
                    <div class="column">Дата регистрации</div>
                    <div class="column">Номер чека</div>
                    <div class="column">Номер кассы</div>
                </div>
                <div class="body">
                    @foreach(Auth::user()->checks()->get() as $check)
                        <div class="row">
                            <div class="column">{{ $check->created_at->format('d.m.Y') }}</div>
                            <div class="column">{{ $check->code }}</div>
                            <div class="column">{{ $check->cash }}</div>
                        </div>
                    @endforeach
                    @for($i = 0 ; $i < 8 - count(Auth::user()->checks); $i++)
                        <div class="row empty"></div>
                    @endfor
                </div>
            </div>
            <a class="button text impact header medium g-trigger-register" href="#check">
                @lang('index.actions.register_check')
            </a>
        </div>
{{--    @endif--}}

@endif

<div class="remodal text header" data-remodal-id="faq-success">
    <button data-remodal-action="close" class="remodal-close"></button>
    @lang('index.modals.faq')
    <button data-remodal-action="close" class="button text">ОК</button>
</div>

<div class="remodal text medium impact" data-remodal-id="ageFilter" data-remodal-options="closeOnOutsideClick: false, hashTracking: false">
    <h1 class="text header">@lang('index.modals.age.header')</h1>

    <div class="row text header">
        <div class="column">
            <button class="button transparent" data-value="0">@lang('index.modals.age.no')</button>
        </div>
        <div class="column">
            <button class="button" data-value="1">@lang('index.modals.age.yes')</button>
        </div>
    </div>
    <div class="bottom text tiny din">
        <a href="#" class="toggle link text header">
            @lang('index.modals.age.promise')
        </a>
        <p class="body">
            @lang('index.modals.age.text')
        </p>
    </div>

</div>

<div class="remodal legal" data-remodal-id="privacy">
    <button data-remodal-action="close" class="remodal-close"></button>

    @lang('index.modals.privacy')
</div>

<div class="remodal legal " data-remodal-id="owner">
    <button data-remodal-action="close" class="remodal-close"></button>

    @lang('index.modals.owner')
</div>
<div class="remodal legal" data-remodal-id="parents" >
    <button data-remodal-action="close" class="remodal-close"></button>

    @lang('index.modals.parents')
</div>

<div class="remodal legal" data-remodal-id="terms">
    <button data-remodal-action="close" class="remodal-close"></button>

    @lang('index.modals.terms')
</div>

<div class="remodal legal" data-remodal-id="contacts">
    <button data-remodal-action="close" class="remodal-close"></button>

    @lang('index.modals.contacts')
</div>
