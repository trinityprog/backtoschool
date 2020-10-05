{{--<div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">--}}
{{--    <label for="name" class="control-label">{{ 'Name' }}</label>--}}
{{--    <input class="form-control" name="name" type="text" id="name" value="{{ isset($winner->name) ? $winner->name : ''}}" required>--}}
{{--    {!! $errors->first('name', '<p class="help-block">:message</p>') !!}--}}
{{--</div>--}}
<div class="form-group {{ $errors->has('phone') ? 'has-error' : ''}}">
    <label for="phone" class="control-label">{{ 'Phone' }}</label>
    <input class="form-control" name="phone" type="text" id="phone" value="{{ isset($winner->phone) ? $winner->phone : ''}}" required>
    {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('city') ? 'has-error' : ''}}">
    <label for="city" class="control-label">{{ 'City' }}</label>
    <input class="form-control" name="city" type="text" id="city" value="{{ isset($winner->city) ? $winner->city : ''}}" required>
    {!! $errors->first('city', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('prize') ? 'has-error' : ''}}">
    <label for="prize" class="control-label">{{ 'Prize' }}</label>
    <input class="form-control" name="prize" type="text" id="prize" value="{{ isset($winner->prize) ? $winner->prize : ''}}" required>
    {!! $errors->first('prize', '<p class="help-block">:message</p>') !!}
</div>

{{--<div class="form-group {{ $errors->has('date_win') ? 'has-error' : ''}}">--}}
{{--    <label for="date_win" class="control-label">{{ 'Дата выигрыша' }}</label>--}}
{{--    <input type="text" class="form-control" name="date_win" value="{{ isset($winner->date_win) ? $winner->date_win->format('d.m.Y') : \Carbon\Carbon::now()->format('d.m.Y') }}">--}}
{{--</div>--}}
{{--<div class="form-group {{ $errors->has('from') ? 'has-error' : ''}}">--}}
{{--    <label for="from" class="control-label">{{ 'Вид' }}</label>--}}
{{--    <select name="from" class="form-control" id="from" >--}}
{{--        @foreach (json_decode('{"web":"web","sms":"sms"}', true) as $optionKey => $optionValue)--}}
{{--            <option value="{{ $optionKey }}" {{ (isset($check->status) && $check->status == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>--}}
{{--        @endforeach--}}
{{--    </select>--}}
{{--    {!! $errors->first('from', '<p class="help-block">:message</p>') !!}--}}
{{--</div>--}}


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Изменить' : 'Добавить' }}">
</div>
<script>
    $(document).ready(function (){
        $('input[name="phone"]').inputmask("+374 99 99 99 99");
{{--        $('input[name="date_win"]').daterangepicker({--}}
{{--            "singleDatePicker": true,--}}
{{--            "buttonClasses": "ui mini button",--}}
{{--            "applyButtonClasses": "primary",--}}
{{--            "locale": {--}}
{{--                "format": "DD.MM.YYYY",--}}
{{--                "separator": " - ",--}}
{{--                "applyLabel": "Применить",--}}
{{--                "cancelLabel": "Отмена",--}}
{{--                "fromLabel": "От",--}}
{{--                "toLabel": "До",--}}
{{--                "customRangeLabel": "Свой",--}}
{{--                "daysOfWeek": [--}}
{{--                    "Вс",--}}
{{--                    "Пн",--}}
{{--                    "Вт",--}}
{{--                    "Ср",--}}
{{--                    "Чт",--}}
{{--                    "Пт",--}}
{{--                    "Сб"--}}
{{--                ],--}}
{{--                "monthNames": [--}}
{{--                    "Январь",--}}
{{--                    "Февраль",--}}
{{--                    "Март",--}}
{{--                    "Апрель",--}}
{{--                    "Май",--}}
{{--                    "Июнь",--}}
{{--                    "Июль",--}}
{{--                    "Август",--}}
{{--                    "Сентябрь",--}}
{{--                    "Октябрь",--}}
{{--                    "Ноябрь",--}}
{{--                    "Декабрь"--}}
{{--                ],--}}
{{--                "firstDay": 1--}}
{{--            }--}}

{{--        }, function(start) {--}}
{{--            $("#start").val(start.format('DD.MM.YYYY'));--}}
{{--        });--}}
    })
</script>
