@if(!Auth::check())
    <div class="remodal" data-remodal-id="registration">
        <button data-remodal-action="close" class="remodal-close"></button>
        <form action="{{ url("/registration") }}" method="POST" class="form column text medium">
            @csrf
            <h1 class="text big header">@lang('index.modals.reg.header')</h1>
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
            <div class="column">
                <div class="input row">
                    <input type="checkbox" name="rules" id="rules" class="@error('rules') error @enderror">
                    <label for="rules" class="checkbox"></label>
                    <label for="rules" class="text tiny din">@lang('index.modals.reg.checkbox')</label>
                </div>
            </div>
            <button class="button text">@lang('index.modals.reg.action')</button>
        </form>
        <p class="text tiny reg-text">
            @lang('index.modals.reg.text')
        </p>
        <div class="bottom column text medium header">
            @lang('index.modals.reg.bottom')
        </div>
    </div>

    <div class="remodal" data-remodal-id="authorization">
        <button data-remodal-action="close" class="remodal-close"></button>
        <form action="{{ url("/authorization") }}" method="POST" class="form column text medium">
            @csrf
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
        @lang('index.modals.check-success')
            <a class="button text header big g-trigger-register" href="#check">
                @lang('index.actions.register_check')
            </a>

    </div>

        <div class="remodal text header" data-remodal-id="check">
            <button data-remodal-action="close" class="remodal-close"></button>
            <form class="form text medium column" action="{{ url('/check') }}" method="POST">
                @csrf
                <h1 class="text header">@lang('index.modals.check.top')</h1>
                <h2 class="text din header small">@lang('index.modals.check.text')</h2>
                <div class="form-wrap">
                    <div class="form-items">
                        <div class="input @error('check') error @enderror">
                            <input type="text" name="check" placeholder="@lang('index.profile.table.check')" id="check">
                        </div>
                        <span class="text error tiny">
                            @error('check') {{ $message }} @enderror
                        </span>
                        <div class="input @error('cash') error @enderror">
                            <input type="text" name="cash"  placeholder="@lang('index.profile.table.cash')" id="cash">
                        </div>
                        <span class="text error tiny">
                            @error('cash') {{ $message }} @enderror
                        </span>
                        <button type="submit" class="button text header g-trigger-register">
                            @lang('index.actions.register')
                        </button>
                    </div>
                    <div class="text medium header alert">@lang('index.modals.check.save_check')</div>
                </div>
            </form>

        </div>

        <div class="remodal text header" data-remodal-id="profile">
            <button data-remodal-action="close" class="remodal-close"></button>
            <div class="top column">
                <h1 class="text header">{{ Auth::user()->email }}</h1>
                <h2 class="text header medium">@lang('index.profile.top')<i class="icon yerevan-city"></i></h2>
                <div class="text alert small header">@lang('index.profile.alert')</div>
            </div>
            <div class="text small header column table">
                <div class="text row head">
                    <div class="column">@lang('index.profile.table.data_reg')</div>
                    <div class="column">@lang('index.profile.table.check')</div>
                    <div class="column">@lang('index.profile.table.cash')</div>
                </div>
                <div class="body">
                    @foreach(Auth::user()->checks()->get() as $check)
                        <div class="row">
                            <div class="column">{{ $check->created_at->format('d.m.Y') }}</div>
                            <div class="column">{{ $check->check }}</div>
                            <div class="column">{{ $check->cash }}</div>
                        </div>
                    @endforeach
                    @for($i = 0 ; $i < 8 - count(Auth::user()->checks); $i++)
                        <div class="row empty"></div>
                    @endfor
                </div>
            </div>
            <a class="button text header medium g-trigger-register" href="#check">
                @lang('index.actions.register_check')
            </a>
        </div>

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
