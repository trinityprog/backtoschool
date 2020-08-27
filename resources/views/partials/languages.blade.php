<div class="row text impact header">
    <a href="{{ url("/language/kk") }}" @if(app()->getLocale() == 'kk') class="active" @endif>Қаз</a>
    &nbsp;|&nbsp;
    <a href="{{ url("/language/ru") }}" @if(app()->getLocale() == 'ru') class="active" @endif>рус</a>
</div>
