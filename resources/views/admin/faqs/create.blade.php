@extends('layouts.app')

@section('content')
    <div class="bodytext">
        <div class="head">
            <a href="{{ url('/admin/faqs') }}" class="back">< Назад</a>
            <h2>Добавить Faq</h2>

        </div>
        @if ($errors->any())
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <div class="grid">
            <div class="first"></div>
            <div class="main">
                <form method="POST" action="{{ url('/admin/faqs') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">

                    {{ csrf_field() }}
                    @include ('admin.faqs.form', ['formMode' => 'create'])

                </form>

            </div>
        </div>
    </div>
@endsection
