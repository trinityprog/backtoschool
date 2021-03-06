@extends('layouts.app')

@section('content')

    <div class="bodytext">
        <div class="head">
            <h2>Чеки <em>({{ $fc }})</em></h2>
        </div>
        <div class="filter">
            <div class="svg">
                <svg xmlns="http://www.w3.org/2000/svg" width="19.202" height="19.937" viewBox="0 0 19.202 19.937">
                    <path id="funnel" d="M20.159,2.688C20.159.923,15.329,0,10.558,0S.957.923.957,2.688a1.362,1.362,0,0,0,.69,1.069L8.254,12.8v6.73l.024.408h.384l.176-.007L12.862,15.9V12.8l6.607-9.041A1.362,1.362,0,0,0,20.159,2.688Zm-9.6-1.92c5.392,0,8.833,1.137,8.833,1.92s-3.441,1.92-8.833,1.92S1.725,3.471,1.725,2.688,5.166.768,10.558.768Z" transform="translate(-0.957)" fill="#1e202a"/>
                </svg>
            </div>
            <div class="filterdate">
                <p class="gray">Фильтр по дате</p>
                <div class="flex">
                    <div class="left">
                        <form method="GET" action="{{ url('/admin/checks') }}" class="form-act" accept-charset="UTF-8" role="search">
                            <label class="search-date">
                                <input type="text" class="filterdate" name="filter" value="{{ (request()->has('filter')) ? request()->input('filter') : \Carbon\Carbon::createFromDate('01.09.2020')->format('d.m.Y') .' - '.\Carbon\Carbon::now()->format('d.m.Y') }}">
                            </label>

                            <select name="status" class="form-control">
                                <option value="" {{(request()->has('status') && request()->input('status') == '' ? 'selected' : '')}}>Выберите статус</option>
                                <option value="0" {{(request()->has('status') && request()->input('status') == 'Не проверено' ? 'selected' : '')}}>Не проверено</option>
                                <option value="1" {{(request()->has('status') && request()->input('status') == 'Принят' ? 'selected' : '')}}>Принят</option>
                                <option value="2" {{(request()->has('status') && request()->input('status') == 'Отклонен' ? 'selected' : '')}}>Отклонен</option>
                            </select>
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
                    <div class="right">
                        <a href="{{ url('/admin/checks/export/'.
                                    '?filter=' . ((request()->has('filter')) ? request('filter') : '') .
                                    '&status=' . ((request()->has('status')) ? request('status') : '') .
                                    '&from=' . ((request()->has('from')) ? request('from') : '')) .
                                    '&search=' . ((request()->has('search')) ? request('search') : '')
                                    }}" class="export-import">
                            <svg xmlns="http://www.w3.org/2000/svg" width="9.027" height="12.035" viewBox="0 0 9.027 12.035">
                                <g id="export" transform="translate(-68.891 0)">
                                    <path d="M77.541,172.228H76.413v.752h.752v6.77H69.643v-6.77H70.4v-.752H69.267a.376.376,0,0,0-.376.376v7.522a.376.376,0,0,0,.376.376h8.274a.376.376,0,0,0,.376-.376V172.6A.376.376,0,0,0,77.541,172.228Z" transform="translate(0 -168.467)" fill="#fff"/>
                                    <path d="M162.2,1.44V6.77h.752V1.44l1.615,1.615.532-.532L162.574,0l-2.523,2.523.532.532Z" transform="translate(-89.169 0)" fill="#fff"/>
                                </g>
                            </svg>
                            {{ (request()->has('filter') || (request()->has('search')) || (request()->has('from')) || (request()->has('status')))  ? 'Экспорт фильтра' : 'Экспорт' }}
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="table">
            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Дата/Время</th>
                    <th>Номер чека и кассы</th>
                    <th>Вид</th>
                    <th>Имя</th>
                    <th>Телефон</th>
                    <th>Статус</th>
                    <th style="text-align: right">Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($checks as $item)
                    <tr >
                        <td style="border-left: 5px solid @if($item->status == 1) mediumseagreen @elseif($item->status == 2) red @else orange; padding-left: 7px @endif">{{ $loop->iteration }}</td>
                        <td>{{ $item->created_at->format('d.M.Y H:i:s') }}</td>
                        <td>{{ $item->check . " " . $item->cash }}</td>
                        <td>{{ $item->from }}</td>
                        <td>{{ $item->user->name }}</td>
                        <td>{{ $item->user->email }}</td>
                        <td>
                            @switch($item->status)
                                @case(0)
                                    {{ 'Не проверено' }}
                                @break
                                @case(1)
                                    {{ 'Принят' }}
                                @break
                                @case(2)
                                    {{ 'Отклонен' }}
                                @break
                            @endswitch
                        </td>
                        <td style="text-align: right">
                            <a href="{{ url('/admin/checks/' . $item->id . '/edit') }}" title="Edit Brand"><button class="btn btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Изменить</button></a>
                            <form method="POST" action="{{ url('/admin/checks' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Brand" onclick="return confirm(&quot;Точно?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Удалить</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="pagination-wrapper">
                {!!
                    $checks->appends([
                    'search' => Request::get('search'),
                    'date-from' => Request::get('date-from'),
                    'date-to' => Request::get('date-to'),
                    'from' => Request::get('from'),
                    'status' => Request::get('status'),
                    ])->render()
                !!}
            </div>
        </div>
    </div>
    <div class="remodal form-import" data-remodal-id="import">
        <button data-remodal-action="close" class="remodal-close"></button>
        <h3 class="import-h3">Импорт Checks</h3>
        <div class="example">
            Пример заполнения файла
        </div>
        <table>
            <thead>
                <tr>
                    <th>photo</th><th>status</th><th>user_id</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Photo</td><td>Status</td><td>User Id</td>
                </tr>
            </tbody>
        </table>
        <form method="post" action="{{url('/admin/checks/import')}}" enctype="multipart/form-data">
            @csrf
            <input type="file" class="input-import" name="file">
            <button type="submit" class="export-import" style="border:none; cursor: pointer">Импорт</button>
        </form>
    </div>
    <script src="{{ asset('js/remodal.min.js') }}"></script>
@endsection
