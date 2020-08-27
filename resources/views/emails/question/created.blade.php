@component('mail::message')
# Новый вопрос

@component('mail::table')
    | ИМЯ       | Email         | Phone  |
    | ------------- |:-------------:| --------:|
    | {{ $question->name }}        |        {{ $question->email }}        |        {{ $question->phone }} |
@endcomponent
<br>
<hr>
<br>
{{ $question->question }}

@endcomponent
