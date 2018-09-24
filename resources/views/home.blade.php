@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <subject-component></subject-component>  
        </div>
        <div class="col-md-8">
            <instruction-component></instruction-component>  
        </div>
    </div>
</div>
@endsection
