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
                                    <strong>{{$question->votes_count}} </strong>{{str_plural('vote',$question->votes_count)}}
                                </div>
                                <div class="status {{$question->status}}">
                                    <strong>{{$question->answers_count }} </strong>{{str_plural('answer',$question->answers_count)}}
                                </div>
                                <div class="view">
                                    {{$question->views}}<br>{{str_plural('view',$question->views)}}
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
            @guest 
            <div class="card  mt-2" style="text-align:center;background:palegoldenrod;margin:0 auto;">
                <div class="card-header" style="background:coral;border:peru 1px solid;border-radius:10px;width:50%;margin:10px auto">
                    <strong>Would you like to ask a question?</strong>
                </div>
                <div class="card-body" style="text-align:center">
                    
                    <a href="{{url('/login')}}" class="btn btn-outline-success">Are you a member? Login here</a>
                    
                    <a href="{{url('/register')}}" class="btn btn-outline-primary ">It is never too late to register here</a>
                </div>
                {{-- <div class="card-footer text-muted">
                    Footer
                </div> --}}
            </div>
            @endguest
        </div>
    </div>
</div>
@endsection