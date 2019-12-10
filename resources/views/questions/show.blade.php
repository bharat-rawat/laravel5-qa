@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h2>{{{$question->title}}}</h2>
                        <div class="ml-auto">
                            <a href="{{route('question.index')}}" class="btn btn-outline-secondary">All Questions</a>
                        </div>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="media">
                        <div class="d-flex flex-column vote-control">
                            <a href="#" title="This question is useful" class="vote-up">
                                <i class="fas fa-caret-up fa-2x"></i>
                            </a>
                            <span class="voteup-count">123</span>
                            <a href="#" title="This question is not useful" class="vote-down off">
                                <i class="fas fa-caret-down  fa-2x "></i> 
                            </a>
                            <a title="Add this question to favrourite question" 
                                
                               class="vote-fav {{\Auth::guest()?'off': ($question->is_favourited?'favourited':'')}}"
                               onclick="event.preventDefault();document.getElementById('favourite-{{$question->id}}').submit()">
                                <i class="fas fa-star fa-2x" ></i>
                            </a>
                        <form action="/question/{{$question->id}}/favourite" method="POST" style="display:none" id = "favourite-{{$question->id}}">
                            @csrf
                            @if($question->is_favourited)
                             @method('DELETE')
                            @endif 
                            </form>
                            <span class="fav-count">{{$question->favourite_count}}</span>
                        </div>
                        <div class="media-body">
                            <div class="d-flex align-items-center">
                                <h3 class="mt-0"><a href="{{$question->url}}">{{$question->title}}</a></h3>
                                @if(Auth::user() && Auth::user()->can('update',$question))
                                    <div class="ml-auto">
                                        <a href="{{route('question.edit',$question->id)}}" class="btn btn-outline-primary">Edit</a>
                                    </div> 
                                @endif
                            </div>
                            <p class="lead">
                                Created by
                                <a href="{{$question->user->url}}">{{$question->user->name}}</a>
                                <small class="text-muted">{{$question->created_date}}</small>
                            </p>
                            <hr>
                            {!!nl2br($question->body) !!} 
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-3">
                @include('answers._index',['answers'=>$question->answers,
                                            'answerCount'=>$question->answers_count])
               
            </div>
            @if (Auth::id())
                <div class="card mt-3">
                    @include('answers.create');
                </div>
            @else
                <div class="card  mt-2" style="text-align:center;background:palegoldenrod;margin:0 auto;">
                    <div class="card-header" style="background:coral;border:peru 1px solid;border-radius:10px;width:50%;margin:10px auto">
                        <strong>Would you like to share your answer?</strong>
                    </div>
                    <div class="card-body" style="text-align:center">
                        
                        <a href="{{url('/login')}}" class="btn btn-outline-success">Are you a member? Login here</a>
                        
                        <a href="{{url('/register')}}" class="btn btn-outline-primary ">It is never too late to register here</a>
                    </div>
                    {{-- <div class="card-footer text-muted">
                        Footer
                    </div> --}}
                </div>
                
            @endif
        </div>
    </div>
</div>
@endsection