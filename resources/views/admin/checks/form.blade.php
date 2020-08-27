
<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">
    <label for="status" class="control-label">{{ 'Status' }}</label>
    <select name="status" class="form-control" id="status" >
        @foreach (json_decode('{"\u041d\u0435 \u043f\u0440\u043e\u0432\u0435\u0440\u0435\u043d\u043e":"\u041d\u0435 \u043f\u0440\u043e\u0432\u0435\u0440\u0435\u043d\u043e","\u041f\u0440\u0438\u043d\u044f\u0442":"\u041f\u0440\u0438\u043d\u044f\u0442","\u041e\u0442\u043a\u043b\u043e\u043d\u0435\u043d":"\u041e\u0442\u043a\u043b\u043e\u043d\u0435\u043d"}', true) as $optionKey => $optionValue)
            <option value="{{ $optionKey }}" {{ (isset($check->status) && $check->status == $optionKey) ? 'selected' : ''}}>{{ $optionValue }}</option>
        @endforeach
    </select>
    {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
</div>


<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Изменить' : 'Добавить' }}">
</div>