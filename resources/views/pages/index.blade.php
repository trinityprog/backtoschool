@extends('layouts.main')

@section('title')
    {{ env('APP_NAME') }} - YEREVAN CITY
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
                    <div class="logo">
                        <img src="{{ asset("/images/logo.png") }}">
                    </div>

                    <div class="text small">
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
        <div class="middle">
            <div class="container column">
                <a href="tel:099955226" class="text">
                    @lang('index.hero.middle')
                </a>
            </div>
        </div>
        <div class="bottom">
            <div class="container column">
                <a class="icon button text header big g-trigger-register" href="@auth #profile @else #authorization @endauth">@lang('index.actions.upload')</a>
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
                        @lang('index.mechanics.1')
                    </div>
                    <div class="step column" data-aos="fade-left" data-aos-delay="300">
                        <div class="image" style="background-image: url('/images/steps/02.png')">
                            <div class="number text impact big">2</div>
                        </div>
                        @lang('index.mechanics.2')
                        <span class="text tiny save-check">@lang('index.actions.save_check')</span>
                    </div>
                    <div class="step column" data-aos="fade-left" data-aos-delay="600">
                        <div class="image" style="background-image: url('/images/steps/03.png')">
                            <div class="number text impact big">3</div>
                        </div>
                        @lang('index.mechanics.3')
                    </div>
                </div>
                <span class="rules-sms text header medium">@lang('index.rules_sms')</span>
                <a href="{{ asset("/docs/rules_am.pdf" ) }}" download="@lang('index.rules').pdf" class="link text header medium">@lang('index.rules')</a>
            </div>
        </div>
    </section>

    <section id="prizes" data-aos="fade-up" data-delay="800">
        <div class="text large header">
            @lang('index.prizes')
        </div>
        <div class="main">
            <div class="container column">
                <div class="prizes row">
                    <div class="prize">
                        <div class="image" style="background-image: url('/images/prizes/main/01.png')">
                            <div class="number text impact">
                                <span>x</span><span>4</span>
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
                                <span>x</span><span>50</span>
                            </div>
                        </div>
                    </div>
                    <div class="prize swiper-slide" data-prize-id="2">
                        <div class="image" >
                            <div class="number text impact">
                                <span>x</span><span>20</span>
                            </div>
                        </div>
                    </div>
                    <div class="prize swiper-slide" data-prize-id="3">
                        <div class="image">
                            <div class="number text impact">
                                <span>x</span><span>50</span>
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
        <img src="{{ asset('/images/prizes_bg_1.png') }}" alt="twix bounty" class="bg bg-1">
        <img src="{{ asset('/images/prizes_bg_2.png') }}" alt="snickers" class="bg bg-2">
    </section>

    <section id="winners">
        <div class="container column">
            <div class="text header large">
                @lang('index.header.winners')
            </div>
            <div class="form row text">
                <div class="input">
                    <input type="tel" name="search" placeholder="@lang('index.form.search')">

                </div>
                <button class="button">
                    <i class="icon search"></i>
                </button>
            </div>
            <div class="table column text header medium">
                <div class="head text">
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
            <div class="text header large">
                @lang('index.faq.header')
            </div>
        </div>
        <div class="text small faq-text">
            @lang('index.faq.text')
        </div>
        <div class="container column">
            <form action="{{ url("/question") }}" class="form column text medium" method="post">
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

                <button type="submit" class="button text header">@lang('index.actions.send')</button>
            </form>

            @foreach(\App\Faq::orderBy('order', 'asc')->get() as $faq)
                <div class="faq column">
                    <div class="title text header medium">{{ $faq->question }}</div>
                    <div class="body text">{!! $faq->answer !!} </div>
                </div>
            @endforeach

        </div>
    </section>



    <a href="#hero" class="yellow button text header" id="up">@lang('index.actions.up')</a>
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
