@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h2>{{{$question->title}}}</h2>
                        <div class="col-md-2">
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
            <div class="card mt-3">
                @include('answers._index',['answers'=>$question->answers,
                                            'answerCount'=>$question->answers->count()])
               
            </div>
            <div class="card mt-3">
                @include('answers.create');
            </div>
        </div>
    </div>
</div>
@endsection