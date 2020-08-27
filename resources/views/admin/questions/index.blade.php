@extends('layouts.app')

@section('content')

    <div class="bodytext">
        <div class="head">
            <h2>Вопросы</h2>
        </div>
        <div class="table">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th><th>Имя</th><th>Email</th><th>Телефон</th><th style="text-align: right">Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($questions as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td><td>{{ $item->email }}</td><td>{{ $item->phone }}</td>
                        <td style="text-align: right">
                            <a href="{{ url('/admin/questions/' . $item->id . '/edit') }}" title="Edit Brand"><button class="btn btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Изменить</button></a>

                            <form method="POST" action="{{ url('/admin/questions' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Brand" onclick="return confirm(&quot;Точно?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Удалить</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="pagination-wrapper"> {!! $questions->appends(['search' => Request::get('search'), 'date-from' => Request::get('date-from'), 'date-to' => Request::get('date-to')])->render() !!} </div>
        </div>
    </div>
    <div class="remodal form-import" data-remodal-id="import">
        <button data-remodal-action="close" class="remodal-close"></button>
        <h3 class="import-h3">Импорт Questions</h3>
        <div class="example">
            Пример заполнения файла
        </div>
        <table>
            <thead>
                <tr>
                    <th>name</th><th>email</th><th>phone</th><th>question</th><th>answer</th><th>answered</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Name</td><td>Email</td><td>Phone</td><td>Question</td><td>Answer</td><td>Answered</td>
                </tr>
            </tbody>
        </table>
        <form method="post" action="{{url('/admin/questions/import')}}" enctype="multipart/form-data">
            @csrf
            <input type="file" class="input-import" name="file">
            <button type="submit" class="export-import" style="border:none; cursor: pointer">Импорт</button>
        </form>
    </div>
    <script src="{{ asset('js/remodal.min.js') }}"></script>
@endsection
