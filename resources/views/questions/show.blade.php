@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h2 style="max-width: 80%">{{$question->title}}</h2>
                        <div class="ml-auto">
                            <a href="{{route('question.index')}}" class="btn btn-outline-secondary">All Questions</a>
                        </div>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="media">
                        <div class="d-flex flex-column vote-control">
                            <a title="This question is useful" 
                                class="vote-up"
                                onclick="event.preventDefault();document.getElementById('voteUpForm').submit();">
                                <i class="fas fa-caret-up fa-4x"></i>
                            </a>
                            <span class="voteup-count">{{$question->votes_count}}</span>
                            <form id="voteUpForm"
                                    method="POST"
                                    action="/question/{{$question->id}}/vote"
                                    style="display:none">
                                    @csrf 
                                    <input type="hidden" name="vote" value="1">
                            </form>
                            <a  title="This question is not useful" 
                                class="vote-down off"
                                onclick="event.preventDefault();document.getElementById('voteDownForm').submit()">
                                <i class="fas fa-caret-down  fa-4x "></i> 
                            </a>
                            <form id="voteDownForm"
                                    method="POST"
                                    action="/question/{{$question->id}}/vote"
                                    style="display:none">
                                    @csrf 
                                    <input type="hidden" name="vote" value="-1">
                            </form>
                            <a title="Add this question to favrourite question" 
                                
                               class="vote-fav {{\Auth::guest()?'off': ($question->is_favourited?'favourited':'')}}"
                               onclick="event.preventDefault();document.getElementById('favourite-{{$question->id}}').submit()">
                                <i class="fas fa-star" ></i>
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
                            {!!(new Parsedown)->text($question->body)!!} 
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-3">
                @include('answers._index',['answers'=>$question->answers()->orderBy('votes_count','desc')->get(),
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