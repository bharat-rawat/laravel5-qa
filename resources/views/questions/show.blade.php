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
                                    <strong>{{$question->answers }} </strong>{{str_plural('answer',$question->answers)}}
                                </div>
                                <div class="view">
                                    {{$question->views ." ".str_plural('view',$question->views)}}
                                </div>
                            </div>
                            <div class="media-body">
                                <div class="d-flex align-items-center">
                                    <h3 class="mt-0"><a href="{{$question->url}}">{{$question->title}}</a></h3>
                                    @if(Auth::user()->can('update-question',$question))
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
</div>
@endsection