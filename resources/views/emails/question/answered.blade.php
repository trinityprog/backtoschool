@component('mail::message')
# Ответ на вапрос

{!!  $question->question !!}

<br>
<hr>
<br>

{!! $question->answer !!}

@component('mail::button', ['url' => url('/')])
НА САЙТ
@endcomponent

@endcomponent
