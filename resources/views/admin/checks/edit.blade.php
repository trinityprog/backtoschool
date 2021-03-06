@extends('layouts.app')

@section('content')
    <div class="bodytext">
        <div class="head">
            <a href="{{ url('/admin/checks') }}" class="back">< Назад</a>
            <h2>Изменить Check #{{ $check->id }}</h2>

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
                <form method="POST" action="{{ url('/admin/checks/' . $check->id) }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
                    {{ method_field('PATCH') }}
                    {{ csrf_field() }}
                    @include ('admin.checks.form', ['formMode' => 'edit'])

                </form>

            </div>
        </div>
    </div>
@endsection
