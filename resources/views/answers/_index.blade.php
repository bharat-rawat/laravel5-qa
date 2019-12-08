<div class="card-body">
        <h2 class="card-title">{{$answerCount." ".ucfirst(str_plural('answer',$question->answers->count()))}}</h2>
        @include('layouts._messages')
        <hr>
        @foreach ($answers as $answer)
            <div class="media">
                <div class="d-flex flex-column vote-control">
                        <a href="#" title="This answer is useful" class="vote-up">
                            <i class="fas fa-caret-up fa-2x"></i>
                        </a>
                        <span class="voteup-count">123</span>
                        <a href="#" title="This answer is not useful" class="vote-down off">
                            <i class="fas fa-caret-down  fa-2x "></i> 
                        </a>
                        <a href="#" title="Add this answer as the best answer" class="{{$answer->status}}">
                            <i class="fas fa-check" ></i>
                        </a>
                </div>
                <div class="media-body">
                   
                    {!!nl2br($answer->body)!!}
                    
                    <br>
                    <div class="float-left mt-4">
                        @if(Auth::user()->can('update',$answer))
                            <a href="{{route('question.answer.edit',[$question->id,$answer->id])}}" class="btn btn-outline-secondary btn-sm">Update</a>
                        @endif
                        @if(Auth::user()->can('delete',$answer))
                            <form action="{{route('question.answer.destroy',[$question->id,$answer->id])}}" method="POST" class="form-delete">
                
                                @method('delete')
                                @csrf
                                <button type="submit" name="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                            </form>
                        @endif
                    </div>
                    <div class="float-right mt-2">
                    <p class="text-muted">{{$answer->created_date}}</p>
                        <div class="media">
                            <a href="{{$answer->user->url}}" class="pr-2"><img src="{{$answer->user->avatar}}" alt="img"></a>
                            <div class="media-body">
                                <a href="{{$answer->user->url}}">{{$answer->user->name}}<a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
        @endforeach
    </div>