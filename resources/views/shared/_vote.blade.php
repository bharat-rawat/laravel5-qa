@if ($model instanceof App\Question)
    @php
        $name = 'question';
        $uriSegmentName = 'question'
    @endphp
@else
    @php
        $name = 'answer';
        $uriSegmentName = 'answer'
    @endphp
@endif

<div class="d-flex flex-column vote-control">
        <a title="This {{$name}} is useful" 
            class="vote-up"
            onclick="event.preventDefault();
                    document.getElementById('{{$name}}UpForm-{{$model->id}}').submit();">
            <i class="fas fa-caret-up fa-4x"></i>
        </a>
        <span class="voteup-count">{{$model->votes_count}}</span>
        <form id="{{$name}}UpForm-{{$model->id}}"
                method="POST"
                action="/{{$uriSegmentName}}/{{$model->id}}/vote"
                style="display:none">
                @csrf 
                <input type="hidden" name="vote" value="1">
        </form>
        <a  title="This {{$name}} is not useful" 
            class="vote-down off"
            onclick="event.preventDefault();
            document.getElementById('{{$name}}DownForm-{{$model->id}}').submit();">
        
            <i class="fas fa-caret-down  fa-4x "></i> 
        </a>
        <form id="{{$name}}DownForm-{{$model->id}}"
                method="POST"
                action="/{{$uriSegmentName}}/{{$model->id}}/vote"
                style="display:none">
                @csrf 
                <input type="hidden" name="vote" value="-1">
        </form>

        @if ($model instanceof App\Question)
            @include('shared._favourite',[
                'model'=>$model
            ])
        @else
        @include('shared._favourite',[
            'model'=>$model
            ])
        @endif
        
    </div>