@extends('layouts.app')

@section('content')

    <div class="bodytext">
        <div class="head">
            <h2>Пользователи <em>({{ $fc }})</em></h2>
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
                        <form method="GET" action="{{ url('/admin/users') }}" class="form-act" accept-charset="UTF-8" role="search">
                            <label class="search-date">
                                <input type="text" class="filterdate" name="filter" value="{{ (request()->has('filter')) ? request()->input('filter') : \Carbon\Carbon::createFromDate('20.08.2020')->format('d.m.Y') .' - '.\Carbon\Carbon::now()->format('d.m.Y') }}">
                            </label>

                            <select name="type" class="form-control">
                                <option value="" {{(request()->has('type') && request()->input('type') == '' ? 'selected' : '')}}>Выберите магазин</option>
                                <option {{(request()->has('type') && request()->input('type') == 'magnum' ? 'selected' : '')}}>magnum</option>
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
                        <a href="{{ url('/admin/users/export/'.
                                    '?filter=' . ((request()->has('filter')) ? request('filter') : '') .
                                    '&type=' . ((request()->has('type')) ? request('type') : '')) .
                                    '&search=' . ((request()->has('search')) ? request('search') : '')
                                    }}" class="export-import">
                            <svg xmlns="http://www.w3.org/2000/svg" width="9.027" height="12.035" viewBox="0 0 9.027 12.035">
                                <g id="export" transform="translate(-68.891 0)">
                                    <path d="M77.541,172.228H76.413v.752h.752v6.77H69.643v-6.77H70.4v-.752H69.267a.376.376,0,0,0-.376.376v7.522a.376.376,0,0,0,.376.376h8.274a.376.376,0,0,0,.376-.376V172.6A.376.376,0,0,0,77.541,172.228Z" transform="translate(0 -168.467)" fill="#fff"/>
                                    <path d="M162.2,1.44V6.77h.752V1.44l1.615,1.615.532-.532L162.574,0l-2.523,2.523.532.532Z" transform="translate(-89.169 0)" fill="#fff"/>
                                </g>
                            </svg>
                            {{ (request()->has('filter') || (request()->has('search')) || (request()->has('type')))  ? 'Экспорт фильтра' : 'Экспорт' }}
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
                    <th>Имя</th>
                    <th>Телефон</th>
                    <th>Магазин</th>
                    <th>Чеки</th>
{{--                    <th style="text-align: right">Действия</th>--}}
                </tr>
                </thead>
                <tbody>
                @foreach($users as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->type }}</td>
                        <td>
                            <a href="{{ url("/admin/checks?search=" . $item->email) }}">
                                {{ $item->checks->count() }}
                            </a>

                        </td>
{{--                        <td style="text-align: right">--}}
{{--                            <a href="{{ url('/admin/users/' . $item->id . '/edit') }}" title="Edit Brand"><button class="btn btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Изменить</button></a>--}}
{{--                            --}}
{{--                        </td>--}}
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="pagination-wrapper"> {!! $users->appends([
                'search' => Request::get('search'),
                'date-from' => Request::get('date-from'),
                'date-to' => Request::get('date-to'),
                'type' => Request::get('type'),
                ])->render() !!} </div>
        </div>
    </div>
    <div class="remodal form-import" data-remodal-id="import">
        <button data-remodal-action="close" class="remodal-close"></button>
        <h3 class="import-h3">Импорт Users</h3>
        <div class="example">
            Пример заполнения файла
        </div>
        <table>
            <thead>
                <tr>
                    <th>name</th><th>email</th><th>type</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Name</td><td>Email</td><td>Type</td>
                </tr>
            </tbody>
        </table>
        <form method="post" action="{{url('/admin/users/import')}}" enctype="multipart/form-data">
            @csrf
            <input type="file" class="input-import" name="file">
            <button type="submit" class="export-import" style="border:none; cursor: pointer">Импорт</button>
        </form>
    </div>
    <script src="{{ asset('js/remodal.min.js') }}"></script>
@endsection
