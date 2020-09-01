<div class="form-group {{ $errors->has('question_ru') ? 'has-error' : ''}}">
    <label for="question" class="control-label">{{ 'Вопрос' }}</label>
    <input class="form-control" name="question" type="text" id="question" value="{{ isset($faq->question) ? $faq->question : ''}}" >
    {!! $errors->first('question', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('answer_ru') ? 'has-error' : ''}}">
    <label for="answer" class="control-label">{{ 'Ответ' }}</label>
    <textarea class="form-control" rows="5" name="answer" type="textarea" id="answer" >{{ isset($faq->answer) ? $faq->answer : ''}}</textarea>
    {!! $errors->first('answer', '<p class="help-block">:message</p>') !!}
</div>
<div class="form-group {{ $errors->has('order') ? 'has-error' : ''}}">
    <label for="order" class="control-label">{{ 'Порядок' }}</label>
    <input class="form-control" name="order" type="text" id="order" value="{{ isset($faq->order) ? $faq->order : ''}}" >
    {!! $errors->first('order', '<p class="help-block">:message</p>') !!}
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" value="{{ $formMode === 'edit' ? 'Изменить' : 'Добавить' }}">
</div>
