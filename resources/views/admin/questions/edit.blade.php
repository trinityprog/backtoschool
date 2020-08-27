@extends('layouts.app')

@section('content')
    <div class="bodytext">
        <div class="head">
            <a href="{{ url('/admin/questions') }}" class="back">< Назад</a>
            <h2>Изменить Question #{{ $question->id }}</h2>

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
                <form method="POST" action="{{ url('/admin/questions/' . $question->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                    {{ method_field('PATCH') }}
                    {{ csrf_field() }}
                    @include ('admin.questions.form', ['formMode' => 'edit'])

                </form>

            </div>
        </div>
    </div>
@endsection
