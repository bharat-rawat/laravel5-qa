
<answer-detail :answer="{{$answer}}" inline-template>
    <div class="media">
        @include('shared._vote',['model'=>$answer])
        @if ($answer->status=='vote-accepted')
                <?php $style="background:rgb(192, 240, 192);border-radius:10px;padding:10px"?>
            @else
                <?php $style="";?>
            @endif
        <div class="media-body" style="{{$style}}">
            <form v-if="editing" v-on:submit.prevent="update">
                <div class="form-group">
                    <label for="ans-body">Update your answer here</label>
                    <textarea v-model="body" rows="10" 
                        class="form-control" required></textarea>
                </div> 
                <button class="btn btn-primary" :disabled="isValid">Edit</button>    
                <button v-on:click="cancel" class="btn btn-secondary" type="button">Cancel</button>    
                
            </form> 
            <div v-else>
                <div v-html="body_html"></div>
                {{-- <span >{!! clean(nl2br($answer->body))!!}</span> --}}
            
                <br>
                <div class="float-left mt-4">
                    @if(Auth::user() && Auth::user()->can('update',$answer))
                        <a v-on:click.prevent="edit" class="btn btn-outline-secondary btn-sm">Update</a>
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
                    <user-info :model="{{$answer}}" label="Answered"></user-info>
                </div>
            </div>
        </div>
    </div>
</answer-detail>
