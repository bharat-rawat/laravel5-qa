<div class="card-body">
        <h3>Your Answer</h3>
        <hr>
        <form action="{{route('question.answer.store',$question->id)}}" method="POST">
            @csrf
            <div class="form-group">
              <label for="body">Your Answer</label>
              <textarea class="form-control {{$errors->has('body')?'is-invalid':''}}" name="body" id="body" rows="6"></textarea>
              @if($errors->has('body'))
                <div class="invalid-feedback">
                    <strong>{{$errors->first('body')}}></strong>
                </div>
              @endif
            </div>
            <button name="submit" id="submit" type="submit" class="btn btn-outline-success">Submit</button>
        </form>
    </div>