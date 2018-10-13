@extends('layouts.app')

@section('content')
<div class="row">
<div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="card card-default">
                <div class="card-header">Remember</div>
                    <div class="card-body">
                        <ul class="list-group">
                        @foreach($instructions as $inst)
                            <li class="list-group-item">
                            {{ $inst['instruction'] }}
                            </li>
                        @endforeach
                        </ul>
                        <br>
                        <a href="/student/home"><button class="btn btn-primary">Back</button></a>
                        <a href="/starttest/{{ $subjectId }}">
                            <button class="btn btn-primary" >Start</button>
                        </a>
                   
                    </div>
            </div>
        </div>
 </div>
@endsection