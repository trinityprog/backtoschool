@extends('layouts.app')

@section('content')

    <div class="bodytext">
        <div class="head">
            <h2>Частые вопросы</h2>
            <a href="{{ url('/admin/faqs/create') }}">Добавить</a>
        </div>
        <div class="table">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Вопрос</th>
                    <th>Порядок</th>
                    <th style="text-align: right">Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($faqs as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->question }}</td>
                        <td>{{ $item->order }}</td>
                        <td style="text-align: right">
                            <a href="{{ url('/admin/faqs/' . $item->id . '/edit') }}" title="Edit Brand"><button class="btn btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Изменить</button></a>

                            <form method="POST" action="{{ url('/admin/faqs' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Brand" onclick="return confirm(&quot;Точно?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Удалить</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="pagination-wrapper"> {!! $faqs->appends(['search' => Request::get('search'), 'date-from' => Request::get('date-from'), 'date-to' => Request::get('date-to')])->render() !!} </div>
        </div>
    </div>
    <div class="remodal form-import" data-remodal-id="import">
        <button data-remodal-action="close" class="remodal-close"></button>
        <h3 class="import-h3">Импорт Faqs</h3>
        <div class="example">
            Пример заполнения файла
        </div>
        <table>
            <thead>
                <tr>
                    <th>question_ru</th><th>question_kk</th><th>answer_ru</th><th>answer_kk</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Question Ru</td><td>Question Kk</td><td>Answer Ru</td><td>Answer Kk</td>
                </tr>
            </tbody>
        </table>
        <form method="post" action="{{url('/admin/faqs/import')}}" enctype="multipart/form-data">
            @csrf
            <input type="file" class="input-import" name="file">
            <button type="submit" class="export-import" style="border:none; cursor: pointer">Импорт</button>
        </form>
    </div>
    <script src="{{ asset('js/remodal.min.js') }}"></script>
@endsection
