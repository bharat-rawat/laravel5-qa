<a  title="Add this answer as the best answer" 
    class="{{$model->status}}"
    onclick="event.preventDefault();
    document.getElementById('form-{{$model->id}}').submit();">
    <i class="fas fa-check" ></i>
</a>
<form method="POST" 
    action="{{route('answer.accepted',$model->id)}}" 
    id="form-{{$model->id}}" style="display:none">
    @method('PUT')
@csrf
</form>