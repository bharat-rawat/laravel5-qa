@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h2>All Questions</h2>
                        <div class="ml-auto">
                            <a href="{{route('question.create')}}" class="btn btn-outline-secondary">Ask Question</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @include('layouts._messages')
                        @foreach($questions as $question)
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
                                    <div class="col-md-10 margin-left">
                                        <h3 class="mt-0"><a href="{{$question->url}}">{{$question->title}}</a></h3>
                                    </div>
                                    <div class="ml-auto">
                                        @if(Auth::user() && Auth::user()->can('update',$question))
                                            <a href="{{route('question.edit',$question->id)}}" class="btn btn-outline-primary btn-sm">Edit</a>
                                        @endif
                                        @if(Auth::user() && Auth::user()->can('delete',$question))
                                            <form class="form-delete" action="{{route('question.destroy',$question->id)}}" method="POST">
                                                @method('DELETE')
                                                @csrf                               
                                                <button type="submit" name="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>     
                                            </form>
                                        @endif
                                    </div>
                                </div>
                                <p class="lead">
                                    Created by 
                                    <a href="{{$question->user->url}}">{{$question->user->name}}</a>
                                    <small class="text-muted">{{$question->created_date}}</small>
                                </p>
                                {{str_limit($question->body, 250) }}
                            </div>
                            
                        </div>
                        <hr>
                        @endforeach
                      {{$questions->links()}}
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection