@extends('layouts.main')


@section('content')
    <section id="hero" data-show="0" style="height: 100vh; min-height: unset">
        <div class="container column active" style="padding: 0">
            <img src="{{ asset("/images/snickers.png") }}" class="text" style="width: 27rem;">
            <br><br>
            <h1 class="text large impact header">
                Ошибка!
            </h1>
            <br>
            <h2 class="text header medium din yellow">Попробуй позднее</h2>
            <br><br>
            <a class="button text impact medium header" style="width: 30rem" href="{{ url('/') }}">назад</a>
        </div>
    </section>
@endsection

@section('styles')
    <style>
        #hero > .container.active .text{
            top: 5rem;
        }
        .text.medium{
            font-size: 3.2rem;
            line-height: 3.6rem;
        }
    </style>
@endsection
