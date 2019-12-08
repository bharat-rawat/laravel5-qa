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
                        <div class="d-flex flex-column counters">
                            <div class="vote">
                                <strong>{{$question->votes }} </strong>{{str_plural('vote',$question->votes)}}
                            </div>
                            <div class="status {{$question->status}}">
                                <strong>{{$question->answers_count }} </strong>{{str_plural('answer',$question->answers_count)}}
                            </div>
                            <div class="view">
                                {{$question->views ." ".str_plural('view',$question->views)}}
                            </div>
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