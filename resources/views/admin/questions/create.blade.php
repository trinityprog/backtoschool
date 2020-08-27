@extends('layouts.app')

@section('content')
    <div class="bodytext">
        <div class="head">
            <a href="{{ url('/admin/questions') }}" class="back">< Назад</a>
            <h2>Добавить Question</h2>

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
                <form method="POST" action="{{ url('/admin/questions') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">

                    {{ csrf_field() }}
                    @include ('admin.questions.form', ['formMode' => 'create'])

                </form>

            </div>
        </div>
    </div>
@endsection
