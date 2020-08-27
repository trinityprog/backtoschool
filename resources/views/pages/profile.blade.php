@extends('layouts.main')

@section('title')
    {{ env('APP_NAME') }} - Личный кабинет
@endsection

@section('type')
    @isset($type)
        {{ $type }}
    @endisset
@endsection

@section('styles')
    {{--    <link rel="stylesheet" href="{{ asset("/css/libraries/swiper-bundle.min.css") }}">--}}
@endsection


@section('header')
    @include('partials.header')
@endsection


@section('content')
    <section id="profile">
        <div class="container row">
            <div class="column dropzone-wrapper">
                @lang('index.profile.top')
                <div class="box column">
                    <form action="{{ url("/checks") }}" id="dropzone" class="dropzone text tiny din column" method="post" enctype="multipart/form-data">
                        <div class="dz-message column">
                            <i class="icon camera"></i>
                            <span>
                                @lang('index.profile.message')
                            </span>
                        </div>
                        <div class="fallback">
                            <input name="file" type="file" />
                        </div>
                    </form>
                    <button class="button disabled text impact g-trigger-register">@lang('index.actions.upload')</button>
                    <p class="text small din yellow header">
                        @lang('index.profile.alert')
                    </p>
                </div>
            </div>
            <div class="column table-wrapper">
                <h1 class="text impact big">{{ Auth::user()->email }}</h1>
                <h2 class="text tiny header yellow din">@lang('index.profile.table.alert')</h2>
                <button class="toggle yellow button text large header impact">посмотреть мои чеки</button>

                <div class="text din small header column table">
                    <div class="text impact row head">
                        <div class="column">@lang('index.profile.table.date')</div>
                        <div class="column">@lang('index.profile.table.photo')</div>
                    </div>
                    <div class="body">
                        @foreach(Auth::user()->checks as $check)
                            <div class="row">
                                <div class="column">{{ $check->created_at->format('d.m.Y') }}</div>
                                <div class="column"><a href="{{ asset("/i/" . $check->photo) }}" target="_blank" class="link">@lang('index.profile.table.see')</a></div>
                            </div>
                        @endforeach
                        @for($i = 0 ; $i < 9 - count(Auth::user()->checks); $i++)
                            <div class="row empty"></div>
                        @endfor
                    </div>
                    <tbody>

                    </tbody>
                </div>
            </div>
        </div>
    </section>
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
            profile();
        });
    </script>
@endsection