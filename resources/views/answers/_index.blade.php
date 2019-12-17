@if($answerCount >0)
<div class="card-body" v-cloak>
    
    <h2 class="card-title">{{$answerCount." ".ucfirst(str_plural('answer',$answerCount))}}</h2>

    @include('layouts._messages')
    <hr>
    @foreach ($answers as $answer)
        @include('answers._answer',['answer'=>$answer])
        <hr>
    @endforeach
</div>
 @endif