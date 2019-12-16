@if($answerCount >0)
<div class="card-body">
    
        <h2 class="card-title">{{$answerCount." ".ucfirst(str_plural('answer',$answerCount))}}</h2>
    
        @include('layouts._messages')
        <hr>
        @foreach ($answers as $answer)
            <div class="media">
                <div class="d-flex flex-column vote-control">
                        <a  title="This answer is useful" 
                            class="vote-up"
                            onclick="event.preventDefault();document.getElementById('ansUp-{{$answer->id}}').submit()"
                            >
                            <i class="fas fa-caret-up fa-2x"></i>
                        </a>
                        <span class="voteup-count">{{$answer->votes_count}}</span>
                        <form action="/answer/{{$answer->id}}/vote"
                                method="POST" 
                                id="ansUp-{{$answer->id}}" style="display:none">
                                @csrf 
                                <input type="hidden" name="vote" value="1">
                        </form>
                        <a  title="This answer is not useful" 
                            class="vote-down off"
                            onclick="event.preventDefault();document.getElementById('ansDown-{{$answer->id}}').submit()">
                            <i class="fas fa-caret-down  fa-2x "></i> 
                        </a>
                        <form action="/answer/{{$answer->id}}/vote"
                            method="POST" 
                            id="ansDown-{{$answer->id}}" style="display:none">
                            @csrf 
                            <input type="hidden" name="vote" value="-1">
                        </form>
                        <a  title="Add this answer as the best answer" 
                            class="{{$answer->status}}"
                            onclick="event.preventDefault();document.getElementById('form-{{$answer->id}}').submit();">
                            <i class="fas fa-check" ></i>
                        </a>
                    <form method="POST" action="{{route('answer.accepted',$answer->id)}}" id="form-{{$answer->id}}" style="display:none">
                        @method('PUT')
                        @csrf
                    </form>
                </div>
                @if ($answer->status=='vote-accepted')
                        <?php $style="background:rgb(192, 240, 192);border-radius:10px;padding:10px"?>
                    @else
                        <?php $style="";?>
                    @endif
                <div class="media-body" style="{{$style}}">
                        
                    <span >{!! clean(nl2br($answer->body))!!}</span>
                    
                    <br>
                    <div class="float-left mt-4">
                        @if(Auth::user() && Auth::user()->can('update',$answer))
                            <a href="{{route('question.answer.edit',[$question->id,$answer->id])}}" class="btn btn-outline-secondary btn-sm">Update</a>
                        @endif
                        @if(Auth::user() && Auth::user()->can('delete',$answer))
                            <form action="{{route('question.answer.destroy',[$question->id,$answer->id])}}" method="POST" class="form-delete">
                
                                @method('delete')
                                @csrf
                                <button type="submit" name="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                            </form>
                        @endif
                    </div>
                    <div class="float-right mt-2">
                    <p class="text-muted">Answered {{ $answer->created_date}}</p>
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
    @endif