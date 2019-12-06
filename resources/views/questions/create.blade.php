@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h2>Ask a Question</h2>
                        <div class="ml-auto">
                            <a href="{{route('question.index')}}" class="btn btn-outline-secondary">Back to all Question</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                <form action="{{route('question.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title of your question</label>
                        <input 
                            type="text" 
                            name="title" 
                            id="title" 
                            value="{{old('title')}}"
                            class="form-control {{$errors->has('title')?'is-invalid':''}}">
                        @if($errors->has('title'))
                            <div class="invalid-feedback">
                                <strong>{{$errors->first('title')}}</strong>
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="body">Ask your question</label>
                        <textarea 
                            name="body" 
                            id="body" 
                            rows="10" 
                            class="form-control {{$errors->has('body')?'is-invalid':''}}">
                            {{old('body')}}
                        </textarea>
                        @if($errors->has('body'))
                            <div class="invalid-feedback">
                                <strong>{{$errors->first('body')}}</strong>
                            </div>
                        @endif
                    </div>
                    
                    <button type="submit" name="submit" value="submit" id="submit" class="btn btn-outline-secondary btn-lg">Submit this question</button>
                </form>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection