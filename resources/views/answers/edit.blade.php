@extends('layouts.app')

@section('content')
<div class="card-body">
        <h3>Editing answer for : {{$question->title}}</h3>
        <hr>
        <form action="{{route('question.answer.update',[$question->id,$answer->id])}}" method="POST">
    
            @method('PUT')
            @csrf
            <div class="form-group">
              <label for="body">Your Updated Answer</label>
              <textarea class="form-control {{$errors->has('body')?'is-invalid':''}}" name="body" id="body" rows="6">{{old('body',$answer->body)}}</textarea>
              @if($errors->has('body'))
                <div class="invalid-feedback">
                    <strong>{{$errors->first('body')}}></strong>
                </div>
              @endif
            </div>
            <button name="submit" id="submit" type="submit" class="btn btn-outline-success">Submit</button>
        </form>
    </div>
    @endsection