@csrf
<div class="form-group">
    <label for="title">Title of your question</label>
    <input 
        type="text" 
        name="title" 
        id="title" 
        value="{{old('title',$question->title)}}"
        class="form-control {{$errors->has('title')?'is-invalid':''}}">
    @if($errors->has('title'))
        <div class="invalid-feedback">
            <strong>{{$errors->first('title')}}</strong>
        </div>
    @endif
</div>
<div class="form-group">
    <label for="body">Ask your question</label>
    <textarea 
        name="body" 
        id="body" 
        rows="10" 
        class="form-control {{$errors->has('body')?'is-invalid':''}}">
        {{old('body',$question->body)}}
    </textarea>
    @if($errors->has('body'))
        <div class="invalid-feedback">
            <strong>{{$errors->first('body')}}</strong>
        </div>
    @endif
</div>

<button type="submit" name="submit" value="submit" id="submit" class="btn btn-outline-secondary btn-lg">{{$questionText}}</button>