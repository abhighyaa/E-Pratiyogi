@extends('layouts.app')

@section('content')
<div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">Dashboard</div>

                        <div class="card-body">
                            @if (count($questions))
                                @foreach ($questions as $question)
                                    {{$question->question}}<br><br>
                                    {{$question->answer}}
                                    <a href="/updatequestion/{{$question->id}}" class="ml-5">Update</a><br>
                                    <hr>
                                @endforeach
                            @else
                                No related questions
                            @endif

@endsection