@extends('layouts.main')

@section('title')
    {{ env('APP_NAME') }} - MAGNUM
@endsection



@section('styles')
    {{--    <link rel="stylesheet" href="{{ asset("/css/libraries/swiper-bundle.min.css") }}">--}}
@endsection


@section('header')
    @include('partials.header')
@endsection

@section('content')
    <section id="hero" data-show="null">
        <div class="top">
            <div class="container row">
                <div class="column">
                    <div class="logo magnum">
                        <img src="{{ asset("/images/logo.png") }}">
                    </div>

                    <div class="din text small">
                        @lang('index.hero.top')
                    </div>
                </div>
                <div class="column">
                </div>
            </div>
        </div>
        <div class="bag">
            <div class="bounty left"></div>
            <div class="red pen left"></div>
            <div class="twix left"></div>
            <div class="snickers left"></div>
            <div class="blue pen right"></div>
            <div class="ruler left"></div>
        </div>
        <div class="tablet"></div>
        @lang('index.hero.containers')
        <div class="bottom">
            <div class="container column">
                <a class="icon button text impact header big g-trigger-register" href="@auth{{ url("/profile") }}@else #authorization @endauth">@lang('index.actions.upload')</a>
            </div>
        </div>

    </section>

    <section id="mechanics">
        <div class="wrapper">
            <div class="container column">
                <div class="steps row">
                    <div class="step column" data-aos="fade-left">
                        <div class="image" style="background-image: url('/images/steps/01.png')">
                            <div class="number text impact big">1</div>
                        </div>
                        @lang('index.mechanics.magnum.1')
                    </div>
                    <div class="step column" data-aos="fade-left" data-aos-delay="300">
                        <div class="image" style="background-image: url('/images/steps/02.png')">
                            <div class="number text impact big">2</div>
                        </div>
                        @lang('index.mechanics.magnum.2')
                        <a class="icon button text impact header big g-trigger-register" href="@auth{{ url("/profile") }}@else #authorization @endauth"><i class="icon check"></i> @lang('index.actions.upload')</a>
                    </div>
                    <div class="step column" data-aos="fade-left" data-aos-delay="600">
                        <div class="image" style="background-image: url('/images/steps/03.png')">
                            <div class="number text impact big">3</div>
                        </div>
                        @lang('index.mechanics.magnum.3')
                    </div>
                </div>
                <a href="{{ asset("/docs/rules_" . app()->getLocale() . ".pdf" ) }}" download="@lang('index.rules').pdf" class="link text header din medium">@lang('index.rules')</a>
            </div>
        </div>
    </section>

    <section id="prizes" data-aos="fade-up" data-delay="800">
        <div class="text impact large header">
            @lang('index.prizes.magnum')
        </div>
        <div class="main">
            <div class="container column">
                <div class="prizes magnum row">
                    <div class="prize">
                        <div class="image" style="background-image: url('/images/prizes/magnum/main/01.png')">
                            <div class="number text impact">
                                <span>x</span><span>1</span>
                            </div>
                        </div>
                    </div>
                    <div class="prize">
                        <div class="image" style="background-image: url('/images/prizes/magnum/main/02.png')">
                            <div class="number text impact">
                                <span>x</span><span>1</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="weekly">
            <div class="container column swiper-container">
                <div class="prizes row swiper-wrapper">
                    <div class="prize swiper-slide" data-prize-id="1">
                        <div class="image">
                            <div class="number text impact">
                                <span>x</span><span>7</span>
                            </div>
                        </div>
                    </div>
                    <div class="prize swiper-slide" data-prize-id="2">
                        <div class="image" >
                            <div class="number text impact">
                                <span>x</span><span>7</span>
                            </div>
                        </div>
                    </div>
                    <div class="prize swiper-slide" data-prize-id="3">
                        <div class="image">
                            <div class="number text impact">
                                <span>x</span><span>7</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="navigation">
                    <button class="swiper-button-prev"></button>
                    <button class="swiper-button-next"></button>
                </div>

            </div>
        </div>
    </section>

    <section id="winners">
        <div class="container column">
            <div class="text impact header large">
                @lang('index.header.winners')
            </div>
            <div class="form row text din">
                <div class="input">
                    <input type="tel" name="search" placeholder="@lang('index.form.search')">

                </div>
                <button class="button">
                    <i class="icon search"></i>
                </button>
            </div>
            <div class="table column text header medium din">
                <div class="head text impact">
                    <div class="row">
                        <div class="column">@lang('index.form.phone')</div>
                        <div class="column">@lang('index.form.city')</div>
                        <div class="column">@lang('index.form.prize')</div>
                    </div>
                </div>
                <div class="body"></div>

            </div>
        </div>
    </section>
    <section id="faq">
        <div class="container column">
            <div class="text impact header large">
                @lang('index.faq.header')
            </div>
            <div class="text din medium">
                @lang('index.faq.text')
            </div>
            <form action="{{ url("/question") }}" class="form column text medium din" method="post">
                @csrf
                <div class="row">
                    <div class="column">
                        <div class="input @error('name') error @enderror">
                            <input type="text" name="name" placeholder="@lang('index.form.name')" value="{{ old('name') }}">
                        </div>
                        <span class="text error tiny">
                            @error('name') {{ $message }} @enderror
                        </span>
                    </div>
                    <div class="column">
                        <div class="input @error('email') error @enderror">
                            <input type="email" name="email" placeholder="@lang('index.form.email')" value="{{ old('email') }}">
                        </div>
                        <span class="text error tiny">
                            @error('email') {{ $message }} @enderror
                        </span>
                    </div>
                    <div class="column">
                        <div class="input @error('phone') error @enderror">
                            <input type="tel" name="phone" placeholder="@lang('index.form.phone')" value="{{ old('phone') }}">
                        </div>
                        <span class="text error tiny">
                            @error('phone') {{ $message }} @enderror
                        </span>
                    </div>
                </div>
                <div class="input @error('question') error @enderror">
                    <textarea name="question" rows="6" placeholder="@lang('index.form.question')" value="{{ old('question') }}"></textarea>
                </div>

                <button type="submit" class="button text header impact">@lang('index.actions.send')</button>
            </form>

            @foreach(\App\Faq::orderBy('order', 'asc')->get() as $faq)
                <div class="faq column">
                    <div class="title text header medium din">@if(app()->getLocale() == 'kk') {{ $faq->question_kk }} @else {{ $faq->question_ru }} @endif</div>
                    <div class="body text small din">@if(app()->getLocale() == 'kk') {!! $faq->answer_kk !!} @else {!! $faq->answer_ru !!} @endif</div>
                </div>
            @endforeach

        </div>
    </section>



    <a href="#hero" class="yellow button text header din small" id="up">@lang('index.actions.up')</a>
@endsection

@section('footer')
    @include('partials.footer')
@endsection

@section('modals')

    @include('partials.modals')
@endsection

@section('bottom-scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            index();
        });
    </script>
@endsection