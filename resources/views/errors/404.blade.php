@extends('layouts.main')


@section('content')
    <section id="hero" data-show="0" style="height: 100vh; min-height: unset">
        <div class="container column active" style="padding: 0">
            <img src="{{ asset("/images/snickers.png") }}" class="text" style="width: 27rem;">
            <br><br>
            <h1 class="text large header">
                Սխալ: Էջը չի գտնվել
            </h1>
            <br><br>
            <a class="button text medium header" style="width: 30rem" href="{{ url('/') }}">ետ</a>
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
