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
                        @include('shared._vote',['model'=>$question])
                        <div class="media-body">
                            <div class="d-flex align-items-center">
                                <h3 class="mt-0"><a href="{{$question->url}}">{{$question->title}}</a></h3>
                                @if(Auth::user() && Auth::user()->can('update',$question))
                                    <div class="ml-auto">
                                        <a href="{{route('question.edit',$question->id)}}" class="btn btn-outline-primary">Edit</a>
                                    </div> 
                                @endif
                            </div>
                            {!!(new Parsedown)->text($question->body)!!} 
                            <div class="row">
                                <div class="col-4"></div>
                                <div class="col-4"></div>
                                <div class="col-4">
                                    @include('shared._author',[
                                        'model'=>$question,
                                        'label'=>'Asked'
                                    ])
                                </div>
                            </div>
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