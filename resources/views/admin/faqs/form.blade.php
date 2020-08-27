<div class="form-group {{ $errors->has('question_ru') ? 'has-error' : ''}}">
    <label for="question_ru" class="control-label">{{ 'Вопрос Ru' }}</label>
    <input class="form-control" name="question_ru" type="text" id="question_ru" value="{{ isset($faq->question_ru) ? $faq->question_ru : ''}}" >
    {!! $errors->first('question_ru', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('question_kk') ? 'has-error' : ''}}">
    <label for="question_kk" class="control-label">{{ 'Вопрос Kk' }}</label>
    <input class="form-control" name="question_kk" type="text" id="question_kk" value="{{ isset($faq->question_kk) ? $faq->question_kk : ''}}" >
    {!! $errors->first('question_kk', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('answer_ru') ? 'has-error' : ''}}">
    <label for="answer_ru" class="control-label">{{ 'Ответ Ru' }}</label>
    <textarea class="form-control" rows="5" name="answer_ru" type="textarea" id="answer_ru" >{{ isset($faq->answer_ru) ? $faq->answer_ru : ''}}</textarea>
    {!! $errors->first('answer_ru', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('answer_kk') ? 'has-error' : ''}}">
    <label for="answer_kk" class="control-label">{{ 'Ответ Kk' }}</label>
    <textarea class="form-control" rows="5" name="answer_kk" type="textarea" id="answer_kk" >{{ isset($faq->answer_kk) ? $faq->answer_kk : ''}}</textarea>
    {!! $errors->first('answer_kk', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('type') ? 'has-error' : ''}}">
    <label for="type" class="control-label">{{ 'Магазин' }}</label>
    <select name="type" class="form-control" id="type">
        <option value="">Выберите магазин</option>
        <option {{ (isset($faq->type) && $faq->type == 'magnum') ? 'selected' : ''}}>magnum</option>
        <option {{ (isset($faq->type) && $faq->type == 'anvar') ? 'selected' : ''}}>anvar</option>
        <option {{ (isset($faq->type) && $faq->type == 'dina') ? 'selected' : ''}}>dina</option>
    </select>
    {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('order') ? 'has-error' : ''}}">
    <label for="order" class="control-label">{{ 'Порядок' }}</label>
    <input class="form-control" name="order" type="text" id="order" value="{{ isset($faq->order) ? $faq->order : ''}}" >
    {!! $errors->first('order', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Изменить' : 'Добавить' }}">
</div>
