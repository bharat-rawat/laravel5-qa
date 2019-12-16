<a title="Add this question to favrourite question" 
    class="vote-fav {{\Auth::guest()?'off': ($model->is_favourited?'favourited':'')}}"
    onclick="event.preventDefault();
    document.getElementById('favourite-{{$model->id}}').submit()">
    <i class="fas fa-star" ></i>
</a>
<form action="/question/{{$model->id}}/favourite" 
        method="POST" style="display:none" 
        id = "favourite-{{$model->id}}">
    @csrf
    @if($model->is_favourited)
        @method('DELETE')
    @endif 
</form>
<span class="fav-count">{{$model->favourite_count}}</span>