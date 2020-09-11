<div class="ul">
    <a href="{{url('/')}}">На сайт</a>
</div>

{{--<div class="ul">--}}
{{--    <a href="{{url('admin/dashboard')}}">Статистика</a>--}}
{{--</div>--}}


<div class="ul {{ (request()->is('admin/users')) ? 'active' : '' }}">
    <a href="{{url('admin/users')}}">Пользователи <span>{{ \App\User::where('type', '!=', 'admin')->where('status', '!=', -1)->count() }}</span></a>
</div>
<div class="ul {{ (request()->is('admin/checks')) ? 'active' : '' }}">
    <a href="{{url('admin/checks')}}">ЧЕКИ <span>{{ \App\Check::where('status', '!=', -1)->count() }}</span></a>
</div>

<div class="ul {{ (request()->is('admin/winners')) ? 'active' : '' }}">
{{--    <a href="{{url('admin/winners')}}">Победители <span>{{ \App\Winner::where('status', '!=', -1)->count() }}</span></a>--}}
    <a href="{{url('admin/winners')}}">Победители <span>{{ \App\Winner::all()->count() }}</span></a>
</div>
<div class="ul {{ (request()->is('admin/faqs')) ? 'active' : '' }}">
    <a href="{{url('admin/faqs')}}">FAQ <span>{{ \App\Faq::all()->count() }}</span></a>
</div>
<div class="ul {{ (request()->is('admin/questions')) ? 'active' : '' }}">
    <a href="{{url('admin/questions')}}">вопросы от пользователей <span>{{ \App\Question::where('status', '!=', -1)->count() }}</span></a>
</div>

