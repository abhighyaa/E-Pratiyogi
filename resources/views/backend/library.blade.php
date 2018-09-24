@extends('layouts.app')

@section('content')

<div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Dashboard</div>

                        <div class="card-body">
                            @if (count($tags))
                                <br>
                                @foreach ($tags as $tag)
                                    <a href="/tags/{{$tag->id}}">{{$tag->name}}&nbsp;({{count($tag->questions)}})</a>
                                    <br><hr><br>
                                @endforeach
                            @else
                                No questions to display.
                                <br><hr>
                            @endif
                            
                            <button class="btn btn-primary" id="createtags">Add tags to library</button>
                            &nbsp; &nbsp;
                            <button class="btn btn-primary" id="createquestions">Add questions to library</button>

                    <div id="tagsdialog">
                    
                            Create Label
                            <span class="close">&times;</span>
                            <hr>
                        
                        
                        <div class="body">
                            <label for="tags">Tag Name</label>
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="text" id="tag">
                            <br><br>
                        
                            <button class="btn btn-primary" id="createtagindb">Create</button>
                        </div>
                       
                    </div>
@endsection