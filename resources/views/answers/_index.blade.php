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
                        <a href="#" title="Add this answer as the best answer" class="vote-accepted">
                            <i class="fas fa-check" ></i>
                        </a>
                </div>
                <div class="media-body">
                   
                    {!!nl2br($answer->body)!!}
                    <br>
                    <div class="float-right">
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