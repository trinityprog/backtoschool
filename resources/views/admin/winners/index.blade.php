@extends('layouts.app')

@section('content')

    <div class="bodytext">
        <div class="head">
            <h2>Победители</h2>
            <a href="{{ url('/admin/winners/create') }}">Добавить</a>
        </div>
        <div class="filterdate">
            <p class="gray">Фильтр по дате</p>
            <div class="flex">
                <div class="left">
                    <form method="GET" action="{{ url('/admin/winners') }}" class="form-act" accept-charset="UTF-8" role="search">
                        <label class="search-date">
                            <input type="text" class="filterdate" name="filter" value="{{ (request()->has('filter')) ? request()->input('filter') : \Carbon\Carbon::createFromDate('01.09.2020')->format('d.m.Y') .' - '.\Carbon\Carbon::now()->format('d.m.Y') }}">
                        </label>

                        <select name="from" class="form-control">
                            <option value="" {{(request()->has('from') && request()->input('from') == '' ? 'selected' : '')}}>Выберите вид</option>
                            <option {{(request()->has('from') && request()->input('from') == 'web' ? 'selected' : '')}}>web</option>
                            <option {{(request()->has('from') && request()->input('from') == 'sms' ? 'selected' : '')}}>sms</option>
                        </select>
                        <label>
                            <input class="search" type="text" name="search" placeholder="Поиск" value="{{ request('search') }}">
                        </label>
                        <span>
                            <button type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                    </form>
                </div>
{{--                <div class="right">--}}
{{--                    <a href="#import" class="export-import">--}}
{{--                        <svg xmlns="http://www.w3.org/2000/svg" width="9.027" height="12.035" viewBox="0 0 9.027 12.035">--}}
{{--                            <g id="export" transform="translate(77.918 12.035) rotate(180)">--}}
{{--                                <path d="M77.541,172.228H76.413v.752h.752v6.77H69.643v-6.77H70.4v-.752H69.267a.376.376,0,0,0-.376.376v7.522a.376.376,0,0,0,.376.376h8.274a.376.376,0,0,0,.376-.376V172.6A.376.376,0,0,0,77.541,172.228Z" transform="translate(0 -168.467)" fill="#fff"/>--}}
{{--                                <path d="M162.2,1.44V6.77h.752V1.44l1.615,1.615.532-.532L162.574,0l-2.523,2.523.532.532Z" transform="translate(-89.169 0)" fill="#fff"/>--}}
{{--                            </g>--}}
{{--                        </svg>--}}
{{--                        Импорт--}}
{{--                    </a>--}}
{{--                </div>--}}
            </div>
        </div>

        <div class="table">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Имя</th>
                    <th>Телефон</th>
                    <th>Город</th>
                    <th>Приз</th>
                    <th>Дата выигрыша</th>
                    <th>Вид</th>
                    <th style="text-align: right">Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($winners as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->phone }}</td>
                        <td>{{ $item->city }}</td>
                        <td>{{ $item->prize }}</td>
                        <td>{{ $item->date_win->format('d.m.Y') }}</td>
                        <td>{{ $item->from }}</td>
                        <td style="text-align: right">
                            <a href="{{ url('/admin/winners/' . $item->id . '/edit') }}" title="Edit Brand"><button class="btn btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Изменить</button></a>

                            <form method="POST" action="{{ url('/admin/winners' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Brand" onclick="return confirm(&quot;Точно?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Удалить</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="pagination-wrapper"> {!! $winners->appends(
                ['search' => Request::get('search'),
                'date-from' => Request::get('date-from'),
                'date-to' => Request::get('date-to'),
                'from' => Request::get('from'),
                ])->render()!!} </div>
        </div>
    </div>

    <div class="remodal form-import" data-remodal-id="import">
        <button data-remodal-action="close" class="remodal-close"></button>
        <h3 class="import-h3">Импорт Победителей</h3>
        <div class="example">
            Пример заполнения файла
        </div>
        <table>
            <thead>
                <tr>
                    <th>name</th><th>phone</th><th>city</th><th>prize</th><th>web</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>...</td><td>...</td><td>...</td><td>...</td><td>...</td>
                </tr>
                <tr>
                    <td>Имя</td><td>Телефон</td><td>Город</td><td>Приз</td><td>magnum/small/anvar/dina</td>
                </tr>
                <tr>
                    <td>...</td><td>...</td><td>...</td><td>...</td><td>...</td>
                </tr>
            </tbody>
        </table>
        <form method="post" action="{{ url('/admin/winners/import') }}" enctype="multipart/form-data">
            @csrf
            <input type="file" class="input-import" name="file">
            <button type="submit" class="export-import" style="border:none; cursor: pointer">Импорт</button>
        </form>
    </div>
    <script src="{{ asset('js/remodal.min.js') }}"></script>
@endsection
