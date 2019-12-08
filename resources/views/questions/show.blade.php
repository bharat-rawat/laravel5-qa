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
                                <i class="fas fa-caret-up fa-4x"></i>
                            </a>
                            <span class="voteup-count">123</span>
                            <a href="#" title="This question is not useful" class="vote-down off">
                                <i class="fas fa-caret-down  fa-4x "></i> 
                            </a>
                            <a href="#" title="Add this question to favrourite question" class="vote-fav favourited">
                                <i class="fas fa-star fa-2x" ></i>
                            </a>
                            <span class="fav-count">123</span>
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
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">{{$question->answers->count()." ".ucfirst(str_plural('answer',$question->answers->count()))}}</h2>
                    <p class="card-text">Text</p>
                    <hr>
                    @foreach ($question->answers as $answer)
                        <div class="media">
                            <div class="d-flex flex-column vote-control">
                                    <a href="#" title="This answer is useful" class="vote-up">
                                        <i class="fas fa-caret-up fa-4x"></i>
                                    </a>
                                    <span class="voteup-count">123</span>
                                    <a href="#" title="This answer is not useful" class="vote-down off">
                                        <i class="fas fa-caret-down  fa-4x "></i> 
                                    </a>
                                    <a href="#" title="Add this answer as the best answer" class="vote-accepted">
                                        <i class="fas fa-check fa-2x" ></i>
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
            </div>
        </div>
    </div>
</div>
@endsection